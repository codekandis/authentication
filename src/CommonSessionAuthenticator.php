<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Session\SessionHandlerInterface;
use CodeKandis\Session\SessionKeyNotFoundException;
use function sprintf;

/**
 * Represents a common stateful authenticator based on a session.
 * A common authenticator is based on clients providing an ID and a passcode.
 * A stateful authenticator stores the clients permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class CommonSessionAuthenticator implements CommonStatefulAuthenticatorInterface
{
	/**
	 * Represents the error message if a session key does not exist.
	 * @var string
	 */
	protected const ERROR_SESSION_KEY_DOES_NOT_EXIST = 'The session key \'%s\' does not exist in the session.';

	/**
	 * Stores the session handler of the session authenticator.
	 * @var SessionHandlerInterface
	 */
	private SessionHandlerInterface $sessionHandler;

	/**
	 * Stores the session key storing if the client has been authenticated.
	 * @var string
	 */
	private string $sessionKey;

	/**
	 * Constructor method.
	 * @param SessionHandlerInterface $sessionHandler The session handler the authentication adapter is based on.
	 * @param string The session key storing if the client has been authenticated.
	 */
	public function __construct( SessionHandlerInterface $sessionHandler, string $sessionKey )
	{
		$this->sessionHandler = $sessionHandler;
		$this->sessionKey     = $sessionKey;
		$this->initAuthentication();
	}

	/**
	 * Initializes the authentication.
	 */
	private function initAuthentication(): void
	{
		$this->sessionHandler->start();
		if ( false === $this->sessionHandler->has( $this->sessionKey ) )
		{
			$this->sessionHandler->regenerateId( true );
			$this->sessionHandler->set( $this->sessionKey, Permission::DENIED );
		}
		$this->sessionHandler->writeClose();
	}

	/**
	 * @inheritDoc
	 */
	public function isClientGranted(): bool
	{
		$this->sessionHandler->start();
		try
		{
			$permission = $this->sessionHandler->get( $this->sessionKey );
			$this->sessionHandler->writeClose();
		}
		catch ( SessionKeyNotFoundException $exception )
		{
			$this->sessionHandler->destroy();
			throw new AuthenticationIsCorruptedException(
				sprintf(
					static::ERROR_SESSION_KEY_DOES_NOT_EXIST,
					$this->sessionKey
				),
				0,
				$exception
			);
		}

		return $permission === Permission::GRANTED;
	}

	/**
	 * @inheritDoc
	 */
	public function requestPermission( array $registeredClients, CommonClientCredentialsInterface $clientCredentials ): bool
	{
		if ( true === $this->isClientGranted() )
		{
			return true;
		}
		foreach ( $registeredClients as $registeredClientFetched )
		{
			if (
				Permission::GRANTED === $registeredClientFetched->getPermission()
				&& $registeredClientFetched->getId() === $clientCredentials->getId()
				&& $registeredClientFetched->getPassCode() === $clientCredentials->getPassCodeSha512()
			)
			{
				$this->sessionHandler->start();
				$this->sessionHandler->regenerateId( true );
				$this->sessionHandler->set( $this->sessionKey, Permission::GRANTED );
				$this->sessionHandler->writeClose();

				return true;
			}
		}

		return false;
	}

	/**
	 * @inheritDoc
	 */
	public function revokePermission(): void
	{
		$this->sessionHandler->start();
		$this->sessionHandler->regenerateId( true );
		$this->sessionHandler->set( $this->sessionKey, Permission::DENIED );
		$this->sessionHandler->writeClose();
	}
}

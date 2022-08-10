<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Authentication\Configurations\SessionAuthenticatorConfigurationInterface;
use CodeKandis\Session\SessionHandlerInterface;
use CodeKandis\Session\SessionKeyNotFoundException;
use function sprintf;

/**
 * Represents a common stateful authenticator based on a session.
 * A common authenticator is based on clients providing an ID and a password.
 * A stateful authenticator persists the clients' permission.
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
	 * Stores the configuration of the session authenticator.
	 * @var SessionAuthenticatorConfigurationInterface
	 */
	private SessionAuthenticatorConfigurationInterface $configuration;

	/**
	 * Stores the session handler of the session authenticator.
	 * @var SessionHandlerInterface
	 */
	private SessionHandlerInterface $sessionHandler;

	/**
	 * Constructor method.
	 * @param SessionAuthenticatorConfigurationInterface $configuration The configuration of the session authenticator.
	 * @param SessionHandlerInterface $sessionHandler The session handler the authentication adapter is based on.
	 */
	public function __construct( SessionAuthenticatorConfigurationInterface $configuration, SessionHandlerInterface $sessionHandler )
	{
		$this->configuration  = $configuration;
		$this->sessionHandler = $sessionHandler;

		$this->initAuthentication();
	}

	/**
	 * Initializes the authentication.
	 */
	private function initAuthentication(): void
	{
		$registeredClientSessionKey = $this->configuration->getRegisteredClientSessionKey();

		$this->sessionHandler->start();
		if ( false === $this->sessionHandler->has( $registeredClientSessionKey ) )
		{
			$this->sessionHandler->regenerateId( true );
			$this->sessionHandler->set(
				$registeredClientSessionKey,
				new RegisteredCommonClient( '', '', '', Permission::DENIED )
			);
		}
		$this->sessionHandler->writeClose();
	}

	/**
	 * @inheritDoc
	 */
	public function isClientGranted(): bool
	{
		$registeredClientSessionKey = $this->configuration->getRegisteredClientSessionKey();

		$this->sessionHandler->start();
		try
		{
			/**
			 * @var RegisteredCommonClientInterface $registeredClient
			 */
			$registeredClient = $this->sessionHandler->get( $registeredClientSessionKey );
			$this->sessionHandler->writeClose();
		}
		catch ( SessionKeyNotFoundException $exception )
		{
			$this->sessionHandler->destroy();
			throw new AuthenticationIsCorruptedException(
				sprintf( static::ERROR_SESSION_KEY_DOES_NOT_EXIST, $registeredClientSessionKey ),
				0,
				$exception
			);
		}

		return $registeredClient->getPermission() === Permission::GRANTED;
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
				$this->sessionHandler->set(
					$this->configuration
						->getRegisteredClientSessionKey(),
					$registeredClientFetched
				);
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
		$this->sessionHandler->set(
			$this->configuration
				->getRegisteredClientSessionKey(),
			new RegisteredCommonClient( '', '', '', Permission::DENIED )
		);
		$this->sessionHandler->writeClose();
	}
}

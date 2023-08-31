<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Ldap\LdapConnectorInterface;
use CodeKandis\Session\SessionHandlerInterface;
use CodeKandis\Session\SessionKeyNotFoundException;
use function sprintf;

/**
 * Represents an LDAP authenticator based on a session.
 * A LDAP authenticator is based on clients providing an ID and a passcode.
 * A stateful authenticator stores the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class LdapSessionAuthenticator extends AbstractLdapAuthenticator implements LdapStatefulAuthenticatorInterface
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
	 * Stores the session key storing the registered client.
	 * @var string
	 */
	private string $registeredClientSessionKey;

	/**
	 * Constructor method.
	 * @param SessionHandlerInterface $sessionHandler The session handler the authentication adapter is based on.
	 * @param string $registeredClientSessionKey The session key storing the registered client.
	 * @param LdapConnectorInterface $ldapConnector The LDAP connector to be used for authentication.
	 */
	public function __construct( SessionHandlerInterface $sessionHandler, string $registeredClientSessionKey, LdapConnectorInterface $ldapConnector )
	{
		parent::__construct( $ldapConnector );

		$this->sessionHandler             = $sessionHandler;
		$this->registeredClientSessionKey = $registeredClientSessionKey;

		$this->initAuthentication();
	}

	/**
	 * Initializes the authentication.
	 */
	private function initAuthentication(): void
	{
		$this->sessionHandler->start();
		if ( false === $this->sessionHandler->has( $this->registeredClientSessionKey ) )
		{
			$this->sessionHandler->regenerateId( true );
			$this->sessionHandler->set(
				$this->registeredClientSessionKey,
				new RegisteredLdapClient( '', '', '', Permission::DENIED )
			);
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
			/**
			 * @var RegisteredLdapClientInterface $registeredClient
			 */
			$registeredClient = $this->sessionHandler->get( $this->registeredClientSessionKey );
			$this->sessionHandler->writeClose();
		}
		catch ( SessionKeyNotFoundException $exception )
		{
			$this->sessionHandler->destroy();
			throw new AuthenticationIsCorruptedException(
				sprintf(
					static::ERROR_SESSION_KEY_DOES_NOT_EXIST,
					$this->registeredClientSessionKey
				),
				0,
				$exception
			);
		}

		return $registeredClient->getPermission() === Permission::GRANTED;
	}

	/**
	 * @inheritDoc
	 */
	public function requestPermission( LdapClientCredentialsInterface $clientCredentials ): bool
	{
		if ( false === $this->authenticate( $clientCredentials ) )
		{
			return false;
		}

		$this->sessionHandler->start();
		$this->sessionHandler->regenerateId( true );
		$this->sessionHandler->set(
			$this->registeredClientSessionKey,
			new RegisteredLdapClient(
				'',
				$clientCredentials->getId(),
				$clientCredentials->getPassCode(),
				Permission::GRANTED
			)
		);
		$this->sessionHandler->writeClose();

		return true;
	}

	/**
	 * @inheritDoc
	 */
	public function revokePermission(): void
	{
		$this->sessionHandler->start();
		$this->sessionHandler->regenerateId( true );
		$this->sessionHandler->set(
			$this->registeredClientSessionKey,
			new RegisteredLdapClient( '', '', '', Permission::DENIED )
		);
		$this->sessionHandler->writeClose();
	}
}

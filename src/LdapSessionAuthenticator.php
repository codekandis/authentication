<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Authentication\Configurations\LdapSessionAuthenticatorConfigurationInterface;
use CodeKandis\Authentication\Configurations\SessionAuthenticatorConfigurationInterface;
use CodeKandis\Ldap\LdapConnectorInterface;
use CodeKandis\Session\SessionHandlerInterface;
use CodeKandis\Session\SessionKeyNotFoundException;
use function sprintf;

/**
 * Represents an LDAP authenticator based on a session.
 * An LDAP authenticator is based on clients providing an ID and a passcode.
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
	 * Stores the configuration of the LDAP session authenticator.
	 * @var SessionAuthenticatorConfigurationInterface
	 */
	private SessionAuthenticatorConfigurationInterface $configuration;

	/**
	 * Stores the session handler of the LDAP session authenticator.
	 * @var SessionHandlerInterface
	 */
	private SessionHandlerInterface $sessionHandler;

	/**
	 * Constructor method.
	 * @param LdapSessionAuthenticatorConfigurationInterface $configuration The configuration of the LDAP session authenticator.
	 * @param SessionHandlerInterface $sessionHandler The session handler the authentication adapter is based on.
	 * @param LdapConnectorInterface $ldapConnector The LDAP connector to be used for authentication.
	 */
	public function __construct( LdapSessionAuthenticatorConfigurationInterface $configuration, SessionHandlerInterface $sessionHandler, LdapConnectorInterface $ldapConnector )
	{
		parent::__construct( $configuration, $ldapConnector );

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
		$registeredClientSessionKey = $this->configuration->getRegisteredClientSessionKey();

		$this->sessionHandler->start();
		try
		{
			/**
			 * @var RegisteredLdapClientInterface $registeredClient
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
	public function requestPermission( LdapClientCredentialsInterface $clientCredentials ): bool
	{
		if ( false === $this->authenticate( $clientCredentials ) )
		{
			return false;
		}

		$this->sessionHandler->start();
		$this->sessionHandler->regenerateId( true );
		$this->sessionHandler->set(
			$this->configuration
				->getRegisteredClientSessionKey(),
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
			$this->configuration
				->getRegisteredClientSessionKey(),
			new RegisteredLdapClient( '', '', '', Permission::DENIED )
		);
		$this->sessionHandler->writeClose();
	}
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Authentication\Configurations\LdapSessionAuthenticatorConfigurationInterface;
use CodeKandis\Ldap\LdapConnectorInterface;
use CodeKandis\Session\SessionHandlerInterface;

/**
 * Represents the base class of any stateful LDAP authenticator based on a session.
 * An LDAP authenticator is based on clients providing an ID and a key.
 * A stateful authenticator persists the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractLdapSessionAuthenticator extends AbstractLdapAuthenticator implements StatefulAuthenticatorInterface, SessionAuthenticatorInterface, LdapStatefulAuthenticatorInterface
{
	use SessionAuthenticatorTrait;

	/**
	 * Represents the error message if a session key does not exist.
	 * @var string
	 */
	protected const ERROR_SESSION_KEY_DOES_NOT_EXIST = 'The session key \'%s\' does not exist in the session.';

	/**
	 * Constructor method.
	 * @param LdapSessionAuthenticatorConfigurationInterface $configuration The configuration of the LDAP session authenticator.
	 * @param SessionHandlerInterface $sessionHandler The session handler the authentication adapter is based on.
	 * @param RegisteredClientInterface $registeredClientDefault The default registered client for authentication initialization.
	 * @param ?LdapConnectorInterface $ldapConnector The LDAP connector to be used for authentication.
	 */
	public function __construct( LdapSessionAuthenticatorConfigurationInterface $configuration, SessionHandlerInterface $sessionHandler, ?LdapConnectorInterface $ldapConnector, RegisteredClientInterface $registeredClientDefault )
	{
		parent::__construct( $configuration, $ldapConnector );

		$this->configuration           = $configuration;
		$this->sessionHandler          = $sessionHandler;
		$this->registeredClientDefault = $registeredClientDefault;

		$this->initialize();
	}
}

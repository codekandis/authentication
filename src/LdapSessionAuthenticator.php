<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Authentication\Configurations\LdapSessionAuthenticatorConfigurationInterface;
use CodeKandis\Ldap\LdapConnectorInterface;
use CodeKandis\Session\SessionHandlerInterface;

/**
 * Represents an LDAP authenticator based on a session.
 * An LDAP authenticator is based on clients providing an ID and a key.
 * A stateful authenticator persists the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class LdapSessionAuthenticator extends AbstractLdapSessionAuthenticator implements LdapStatefulAuthenticatorInterface
{
	/**
	 * Constructor method.
	 * @param LdapSessionAuthenticatorConfigurationInterface $configuration The configuration of the LDAP session authenticator.
	 * @param SessionHandlerInterface $sessionHandler The session handler the authentication adapter is based on.
	 * @param ?LdapConnectorInterface $ldapConnector The LDAP connector to be used for authentication.
	 */
	public function __construct( LdapSessionAuthenticatorConfigurationInterface $configuration, SessionHandlerInterface $sessionHandler, ?LdapConnectorInterface $ldapConnector )
	{
		parent::__construct(
			$configuration,
			$sessionHandler,
			$ldapConnector,
			new RegisteredCommonClient( '', Permission::DENIED, '', '' )
		);
	}

	/**
	 * @inheritDoc
	 * @throws NoLdapConnectorProvidedException No LDAP connector has been provided.
	 */
	public function requestPermission( CommonClientCredentialsInterface $clientCredentials ): bool
	{
		if ( false === $this->authenticate( $clientCredentials ) )
		{
			return false;
		}

		if ( true === $this->isClientGranted() )
		{
			return true;
		}

		$this->startSession();
		$this->registerClientInSession(
			new RegisteredCommonClient(
				'',
				Permission::GRANTED,
				$clientCredentials->getId(),
				$clientCredentials->getKey(),
			)
		);
		$this->closeSession();

		return true;
	}
}

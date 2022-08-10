<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents a LDAP stateless authenticator.
 * A LDAP authenticator is based on clients providing an ID and a password.
 * A stateless authenticator does not persist the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class LdapStatelessAuthenticator extends AbstractLdapAuthenticator
{
	/**
	 * @inheritDoc
	 * @throws NoLdapConnectorProvidedException No LDAP connector has been provided.
	 */
	public function requestPermission( LdapClientCredentialsInterface $clientCredentials ): bool
	{
		return $this->authenticate( $clientCredentials );
	}
}

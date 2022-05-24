<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents a LDAP stateless authenticator.
 * A LDAP authenticator is based on clients providing an ID and a passcode.
 * A stateless authenticator does not store the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class LdapStatelessAuthenticator extends AbstractLdapAuthenticator
{
	/**
	 * @inheritDoc
	 */
	public function requestPermission( LdapClientCredentialsInterface $clientCredentials ): bool
	{
		return $this->authenticate( $clientCredentials );
	}
}

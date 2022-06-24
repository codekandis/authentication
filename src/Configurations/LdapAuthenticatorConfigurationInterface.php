<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\Configurations;

/**
 * Represents the interface of any LDAP authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface LdapAuthenticatorConfigurationInterface
{
	/**
	 * Gets the permitted LDAP group all clients must be a member of.
	 * @return ?string The permitted LDAP group all clients must be a member of.
	 */
	public function getPermittedLdapGroup(): ?string;
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\Configurations;

/**
 * Represents an LDAP session authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class LdapSessionAuthenticatorConfiguration implements LdapSessionAuthenticatorConfigurationInterface
{
	use LdapAuthenticatorConfigurationTrait;
	use SessionAuthenticatorConfigurationTrait;
}

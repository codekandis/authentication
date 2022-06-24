<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\Configurations;

/**
 * Represents an LDAP authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class LdapAuthenticatorConfiguration implements LdapAuthenticatorConfigurationInterface
{
	use LdapAuthenticatorConfigurationTrait;
}

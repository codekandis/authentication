<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\Configurations;

/**
 * Represents the interface of any LDAP session authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface LdapSessionAuthenticatorConfigurationInterface extends LdapAuthenticatorConfigurationInterface, SessionAuthenticatorConfigurationInterface
{
}

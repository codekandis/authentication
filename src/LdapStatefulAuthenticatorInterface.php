<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all LDAP stateful authenticators.
 * A LDAP authenticator is based on clients providing a key.
 * A stateful authenticator persists the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface LdapStatefulAuthenticatorInterface extends LdapStatelessAuthenticatorInterface
{
}

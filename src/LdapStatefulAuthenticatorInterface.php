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
	/**
	 * Determines if the client has been granted permission.
	 * @return bool True if the client has been granted permission, false otherwise.
	 * @throws AuthenticationIsCorruptedException The authentication data is corrupted.
	 */
	public function isClientGranted(): bool;

	/**
	 * Revokes the permission of the client.
	 */
	public function revokePermission(): void;
}

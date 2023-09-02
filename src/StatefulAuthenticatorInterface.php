<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all stateful authenticators.
 * A stateful authenticator persists the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface StatefulAuthenticatorInterface
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

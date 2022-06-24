<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all key based stateless authenticators.
 * A key based authenticator is based on clients providing a key.
 * A stateless authenticator does not persist the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface KeyBasedStatelessAuthenticatorInterface
{
	/**
	 * Requests to grant the client permission.
	 * @param RegisteredKeyBasedClientInterface[] $registeredClients The registered clients.
	 * @param KeyBasedClientCredentialsInterface $clientCredentials The credentials of the client requesting permission.
	 * @return bool True if the client has been granted permission, false otherwise.
	 */
	public function requestPermission( array $registeredClients, KeyBasedClientCredentialsInterface $clientCredentials ): bool;
}

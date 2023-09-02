<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all common stateless authenticators.
 * A common authenticator is based on clients providing an ID and a key.
 * A stateless authenticator does not persist the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface CommonStatelessAuthenticatorInterface
{
	/**
	 * Requests to grant the client permission.
	 * @param RegisteredCommonClientInterface[] $registeredClients The registered clients.
	 * @param CommonClientCredentialsInterface $clientCredentials The credentials of the client requesting permission.
	 * @return bool True if the client has been granted permission, false otherwise.
	 */
	public function requestPermission( array $registeredClients, CommonClientCredentialsInterface $clientCredentials ): bool;
}

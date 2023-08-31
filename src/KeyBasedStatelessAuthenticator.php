<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents a key based stateless authenticator.
 * A key based authenticator is based on clients providing a key.
 * A stateless authenticator does not store the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class KeyBasedStatelessAuthenticator implements KeyBasedStatelessAuthenticatorInterface
{
	/**
	 * @inheritDoc
	 */
	public function requestPermission( array $registeredClients, KeyBasedClientCredentialsInterface $clientCredentials ): bool
	{
		foreach ( $registeredClients as $registeredClientFetched )
		{
			if (
				Permission::GRANTED === $registeredClientFetched->getPermission()
				&& $registeredClientFetched->getKey() === $clientCredentials->getKeySha512()
			)
			{
				return true;
			}
		}

		return false;
	}
}

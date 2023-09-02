<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents a common stateless authenticator.
 * A common authenticator is based on clients providing an ID and a key.
 * A stateless authenticator does not persist the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class CommonStatelessAuthenticator implements CommonStatelessAuthenticatorInterface
{
	/**
	 * @inheritDoc
	 */
	public function requestPermission( array $registeredClients, CommonClientCredentialsInterface $clientCredentials ): bool
	{
		foreach ( $registeredClients as $registeredClientFetched )
		{
			if (
				Permission::GRANTED === $registeredClientFetched->getPermission()
				&& $registeredClientFetched->getId() === $clientCredentials->getId()
				&& $registeredClientFetched->getKey() === $clientCredentials->getKeySha512()
			)
			{
				return true;
			}
		}

		return false;
	}
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Authentication\Configurations\SessionAuthenticatorConfigurationInterface;
use CodeKandis\Session\SessionHandlerInterface;

/**
 * Represents a key based stateful authenticator based on a session.
 * A key based authenticator is based on clients providing a key.
 * A stateful authenticator persists the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class KeyBasedSessionAuthenticator extends AbstractSessionAuthenticator implements KeyBasedStatefulAuthenticatorInterface
{
	/**
	 * Constructor method.
	 * @param SessionAuthenticatorConfigurationInterface $configuration The configuration of the session authenticator.
	 * @param SessionHandlerInterface $sessionHandler The session handler the authentication adapter is based on.
	 */
	public function __construct( SessionAuthenticatorConfigurationInterface $configuration, SessionHandlerInterface $sessionHandler )
	{
		parent::__construct(
			$configuration,
			$sessionHandler,
			new RegisteredKeyBasedClient( '', '', Permission::DENIED )
		);
	}

	/**
	 * @inheritDoc
	 */
	public function requestPermission( array $registeredClients, KeyBasedClientCredentialsInterface $clientCredentials ): bool
	{
		if ( true === $this->isClientGranted() )
		{
			return true;
		}
		foreach ( $registeredClients as $registeredClientFetched )
		{
			if (
				Permission::GRANTED === $registeredClientFetched->getPermission()
				&& $registeredClientFetched->getKey() === $clientCredentials->getKeySha512()
			)
			{
				$this->startSession();
				$this->registerClientInSession( $registeredClientFetched );
				$this->closeSession();

				return true;
			}
		}

		return false;
	}
}

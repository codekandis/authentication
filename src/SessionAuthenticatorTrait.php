<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Authentication\Configurations\SessionAuthenticatorConfigurationInterface;
use CodeKandis\Session\SessionHandlerInterface;
use CodeKandis\Session\SessionKeyNotFoundException;
use function sprintf;

/**
 * Represents the trait of any stateful session authenticator.
 * A stateful authenticator persists the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
trait SessionAuthenticatorTrait
{
	/**
	 * Stores the configuration of the session authenticator.
	 * @var SessionAuthenticatorConfigurationInterface
	 */
	private SessionAuthenticatorConfigurationInterface $configuration;

	/**
	 * Stores the session handler of the session authenticator.
	 * @var SessionHandlerInterface
	 */
	private SessionHandlerInterface $sessionHandler;

	/**
	 * Stores the default registered client for authentication initialization.
	 * @var RegisteredClientInterface
	 */
	private RegisteredClientInterface $registeredClientDefault;

	/**
	 * Stores the session key of the registered client.
	 * @var string
	 */
	protected string $registeredClientSessionKey;

	/**
	 * Initializes the authenticator.
	 */
	private function initialize(): void
	{
		$this->registeredClientSessionKey = $this->configuration->getRegisteredClientSessionKey();

		$this->startSession();

		if ( false === $this->isClientRegisteredInSession() )
		{
			$this->registerClientInSession( $this->registeredClientDefault );
		}

		$this->closeSession();
	}

	/**
	 * Starts the session and regenerates the session ID.
	 */
	protected function startSession(): void
	{
		$this->sessionHandler->start();
		$this->sessionHandler->regenerateId();
	}

	/**
	 * Writes and closes the session.
	 */
	protected function closeSession(): void
	{
		$this->sessionHandler->writeClose();
	}

	/**
	 * Destroys the session.
	 */
	protected function destroySession(): void
	{
		$this->sessionHandler->destroy();
	}

	/**
	 * Determines if the client has been registered in the session.
	 * @return bool True if the client has been registered in the session, otherwise false.
	 */
	protected function isClientRegisteredInSession(): bool
	{
		return $this->sessionHandler->has( $this->registeredClientSessionKey );
	}

	/**
	 * Registers a specific client in the session.
	 */
	protected function registerClientInSession( RegisteredClientInterface $registeredClient ): void
	{
		$this->sessionHandler->set( $this->registeredClientSessionKey, $registeredClient );
	}

	/**
	 * Gets a client from the session.
	 * @return RegisteredClientInterface The client.
	 */
	protected function getClientFromSession(): RegisteredClientInterface
	{
		try
		{
			return $this->sessionHandler->get( $this->registeredClientSessionKey );
		}
		catch ( SessionKeyNotFoundException $exception )
		{
			$this->destroySession();
			throw new AuthenticationIsCorruptedException(
				sprintf( static::ERROR_SESSION_KEY_DOES_NOT_EXIST, $this->registeredClientSessionKey ),
				0,
				$exception
			);
		}
	}

	/**
	 * @inheritDoc
	 */
	public function isClientGranted(): bool
	{
		$this->startSession();
		try
		{
			$registeredClient = $this->getClientFromSession();
			$this->closeSession();
		}
		catch ( SessionKeyNotFoundException $exception )
		{
			$this->destroySession();
			throw new AuthenticationIsCorruptedException(
				sprintf( static::ERROR_SESSION_KEY_DOES_NOT_EXIST, $this->registeredClientSessionKey ),
				0,
				$exception
			);
		}

		return Permission::GRANTED === $registeredClient->getPermission();
	}

	/**
	 * @inheritDoc
	 */
	public function revokePermission(): void
	{
		$this->startSession();
		$this->registerClientInSession( $this->registeredClientDefault );
		$this->closeSession();
	}
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\Configurations;

/**
 * Represents the trait of a session authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
trait SessionAuthenticatorConfigurationTrait
{
	/**
	 * Stores the session key used to persist the registered client.
	 * @var string
	 */
	private string $registeredClientSessionKey = '';

	/**
	 * @inheritDoc
	 */
	public function getRegisteredClientSessionKey(): string
	{
		return $this->registeredClientSessionKey;
	}

	/**
	 * Sets the session key used to persist the registered client.
	 * @param string $registeredClientSessionKey The session key used to persist the registered client.
	 */
	public function setRegisteredClientSessionKey( string $registeredClientSessionKey ): void
	{
		$this->registeredClientSessionKey = $registeredClientSessionKey;
	}
}

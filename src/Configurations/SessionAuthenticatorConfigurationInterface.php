<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\Configurations;

/**
 * Represents the interface of any session authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface SessionAuthenticatorConfigurationInterface
{
	/**
	 * Gets the session key used to store the registered client.
	 * @return string The session key used to store the registered client.
	 */
	public function getRegisteredClientSessionKey(): string;
}

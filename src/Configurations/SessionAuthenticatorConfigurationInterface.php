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
	 * Gets the key used to persist the registered client in the session.
	 * @return string The key used to persist the registered client in the session.
	 */
	public function getRegisteredClientSessionKey(): string;
}

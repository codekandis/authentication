<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Configurations\ConfigurationInterface;

/**
 * Represents the interface of any session authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface SessionAuthenticatorConfigurationInterface extends ConfigurationInterface
{
	/**
	 * Gets the session key used to store the registered client.
	 * @return string The session key used to store the registered client.
	 */
	public function getRegisteredClientSessionKey(): string;
}

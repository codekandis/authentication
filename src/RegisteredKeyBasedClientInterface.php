<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of any registered key based client providing a key.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface RegisteredKeyBasedClientInterface extends RegisteredClientInterface
{
	/**
	 * Gets the description of the client.
	 * @return string The description of the client.
	 */
	public function getDescription(): string;

	/**
	 * Gets the key of the client.
	 * @return string The key of the client.
	 */
	public function getKey(): string;

	/**
	 * Gets the permission of the client.
	 * @return int The permission of the client.
	 */
	public function getPermission(): int;
}

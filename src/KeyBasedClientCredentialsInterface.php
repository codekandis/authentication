<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all key based client credentials providing a key.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface KeyBasedClientCredentialsInterface
{
	/**
	 * Gets the key of the client.
	 * @return string The key of the client.
	 */
	public function getKey(): string;

	/**
	 * Gets the SHA512 hash of the key of the client.
	 * @return string The SHA512 hash of the key of the client.
	 */
	public function getKeySha512(): string;
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all common client credentials providing an ID and a key.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface CommonClientCredentialsInterface
{
	/**
	 * Gets the ID of the client.
	 * @return string The ID of the client.
	 */
	public function getId(): string;

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

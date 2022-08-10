<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all common client credentials providing an ID and a password.
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
	 * Gets the password of the client.
	 * @return string The password of the client.
	 */
	public function getPassCode(): string;

	/**
	 * Gets the SHA512 hash of the password of the client.
	 * @return string The SHA512 hash of the password of the client.
	 */
	public function getPassCodeSha512(): string;
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use function hash;

/**
 * Represents key based client credentials providing a key.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class KeyBasedClientCredentials implements KeyBasedClientCredentialsInterface
{
	/**
	 * Stores the key of the client.
	 * @var string
	 */
	private string $key;

	/**
	 * Stores the SHA512 hash of the key of the client.
	 * @var string
	 */
	private string $keySha512;

	/**
	 * Constructor method.
	 * @param string $key The key of the client.
	 */
	public function __construct( string $key )
	{
		$this->key       = $key;
		$this->keySha512 = hash( 'sha512', $key );
	}

	/**
	 * @inheritDoc
	 */
	public function getKey(): string
	{
		return $this->key;
	}

	/**
	 * @inheritDoc
	 */
	public function getKeySha512(): string
	{
		return $this->keySha512;
	}
}

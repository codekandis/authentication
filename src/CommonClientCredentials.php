<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use function hash;

/**
 * Represents common client credentials providing an ID and a key.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class CommonClientCredentials implements CommonClientCredentialsInterface
{
	/**
	 * Stores the ID of the client.
	 * @var string
	 */
	private string $id;

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
	 * @param string $id The ID of the client.
	 * @param string $key The key of the client.
	 */
	public function __construct( string $id, string $key )
	{
		$this->id        = $id;
		$this->key       = $key;
		$this->keySha512 = hash( 'sha512', $key );
	}

	/**
	 * @inheritDoc
	 */
	public function getId(): string
	{
		return $this->id;
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

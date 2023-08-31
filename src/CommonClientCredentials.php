<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use function hash;

/**
 * Represents common client credentials providing an ID and a password.
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
	 * Stores the password of the client.
	 * @var string
	 */
	private string $password;

	/**
	 * Stores the SHA512 hash of the password of the client.
	 * @var string
	 */
	private string $passwordSha512;

	/**
	 * Constructor method.
	 * @param string $id The ID of the client.
	 * @param string $password The password of the client.
	 */
	public function __construct( string $id, string $password )
	{
		$this->id             = $id;
		$this->password       = $password;
		$this->passwordSha512 = hash( 'sha512', $password );
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
	public function getPassCode(): string
	{
		return $this->password;
	}

	/**
	 * @inheritDoc
	 */
	public function getPassCodeSha512(): string
	{
		return $this->passwordSha512;
	}
}

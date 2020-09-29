<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use function hash;

/**
 * Represents common client credentials providing an ID and a passcode.
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
	 * Stores the passcode of the client.
	 * @var string
	 */
	private string $passCode;

	/**
	 * Stores the SHA512 hash of the passcode of the client.
	 * @var string
	 */
	private string $passCodeSha512;

	/**
	 * Constructor method.
	 * @param string $id The ID of the client.
	 * @param string $passCode The passcode of the client.
	 */
	public function __construct( string $id, string $passCode )
	{
		$this->id             = $id;
		$this->passCode       = $passCode;
		$this->passCodeSha512 = hash( 'sha512', $passCode );
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
		return $this->passCode;
	}

	/**
	 * @inheritDoc
	 */
	public function getPassCodeSha512(): string
	{
		return $this->passCodeSha512;
	}
}

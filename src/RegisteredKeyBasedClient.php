<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents a registered key based client providing a key.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class RegisteredKeyBasedClient implements RegisteredKeyBasedClientInterface
{
	/**
	 * Stores the description of the client.
	 * @var string
	 */
	private string $description;

	/**
	 * Stores the key of the client.
	 * @var string
	 */
	private string $key;

	/**
	 * Stores the permission of the client.
	 * @var int
	 */
	private int $permission;

	/**
	 * Constructor method.
	 * @param string $description The description of the client.
	 * @param string $key The key of the client.
	 * @param int $permission The permission of the client.
	 */
	public function __construct( string $description, string $key, int $permission )
	{
		$this->description = $description;
		$this->key         = $key;
		$this->permission  = $permission;
	}

	/**
	 * @inheritDoc
	 */
	public function getDescription(): string
	{
		return $this->description;
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
	public function getPermission(): int
	{
		return $this->permission;
	}
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the base class of any registered client.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractRegisteredClient implements RegisteredClientInterface
{
	/**
	 * Stores the description of the client.
	 * @var string
	 */
	private string $description;

	/**
	 * Stores the permission of the client.
	 * @var int
	 */
	private int $permission;

	/**
	 * Constructor method.
	 * @param string $description The description of the client.
	 * @param int $permission The permission of the client.
	 */
	public function __construct( string $description, int $permission )
	{
		$this->description = $description;
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
	public function getPermission(): int
	{
		return $this->permission;
	}
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents a registered common client providing an ID and a key.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class RegisteredCommonClient extends AbstractRegisteredClient implements RegisteredCommonClientInterface
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
	 * Constructor method.
	 * @param string $description The description of the client.
	 * @param int $permission The permission of the client.
	 * @param string $id The ID of the client.
	 * @param string $key The key of the client.
	 */
	public function __construct( string $description, int $permission, string $id, string $key )
	{
		parent::__construct( $description, $permission );

		$this->id  = $id;
		$this->key = $key;
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
}

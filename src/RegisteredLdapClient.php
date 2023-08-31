<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents a registered LDAP client providing an ID and a password.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class RegisteredLdapClient implements RegisteredCommonClientInterface
{
	/**
	 * Stores the description of the client.
	 * @var string
	 */
	private string $description;

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
	 * Stores the permission of the client.
	 * @var int
	 */
	private int $permission;

	/**
	 * Constructor method.
	 * @param string $description The description of the client.
	 * @param string $id The ID of the client.
	 * @param string $password The password of the client.
	 * @param int $permission The permission of the client.
	 */
	public function __construct( string $description, string $id, string $password, int $permission )
	{
		$this->description = $description;
		$this->id          = $id;
		$this->password    = $password;
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
	public function getPermission(): int
	{
		return $this->permission;
	}
}

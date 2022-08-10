<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents LDAP client credentials providing an ID and a password.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class LdapClientCredentials implements LdapClientCredentialsInterface
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
	 * Constructor method.
	 * @param string $id The ID of the client.
	 * @param string $password The password of the client.
	 */
	public function __construct( string $id, string $password )
	{
		$this->id       = $id;
		$this->password = $password;
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
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents LDAP client credentials providing an ID and a passcode.
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
	 * Stores the passcode of the client.
	 * @var string
	 */
	private string $passCode;

	/**
	 * Constructor method.
	 * @param string $id The ID of the client.
	 * @param string $passCode The passcode of the client.
	 */
	public function __construct( string $id, string $passCode )
	{
		$this->id       = $id;
		$this->passCode = $passCode;
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
}

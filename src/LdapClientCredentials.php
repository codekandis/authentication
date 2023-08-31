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
	 * Stores The name of the group the client must be a member of.
	 * @var ?string
	 */
	private ?string $groupMembership;

	/**
	 * Constructor method.
	 * @param string $id The ID of the client.
	 * @param string $passCode The passcode of the client.
	 * @param ?string $groupMembership The name of the group the client must be a member of or null if no group membership is necessary.
	 */
	public function __construct( string $id, string $passCode, ?string $groupMembership )
	{
		$this->id              = $id;
		$this->passCode        = $passCode;
		$this->groupMembership = $groupMembership;
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
	public function getGroupMembership(): ?string
	{
		return $this->groupMembership;
	}
}

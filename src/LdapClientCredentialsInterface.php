<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of any LDAP client credentials.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface LdapClientCredentialsInterface
{
	/**
	 * Gets the ID of the client.
	 * @return string The ID of the client.
	 */
	public function getId(): string;

	/**
	 * Gets the passcode of the client.
	 * @return string The passcode of the client.
	 */
	public function getPassCode(): string;

	/**
	 * Gets the name of group the client must be a member of.
	 * @return ?string The name of the group the client must be a member of or null if no group membership is necessary.
	 */
	public function getGroupMembership(): ?string;
}

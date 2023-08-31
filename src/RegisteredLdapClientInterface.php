<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all registered LDAP clients providing an ID and a passcode.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface RegisteredLdapClientInterface
{
	/**
	 * Gets the description of the client.
	 * @return string The description of the client.
	 */
	public function getDescription(): string;

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
	 * Gets the permission of the client.
	 * @return int The permission of the client.
	 */
	public function getPermission(): int;
}

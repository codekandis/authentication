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
	 * Gets the password of the client.
	 * @return string The password of the client.
	 */
	public function getPassCode(): string;
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\AuthorizationHeader;

/**
 * Represents the interface of all parsed authorization headers.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ParsedAuthorizationHeaderInterface
{
	/**
	 * Gets the type of the authorization.
	 * @return string The type of the authorization.
	 */
	public function getType(): string;

	/**
	 * Gets the value of the authorization.
	 * @return string The value of the authorization.
	 */
	public function getValue(): string;
}

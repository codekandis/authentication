<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\AuthorizationHeader;

/**
 * Represents the interface of all parsed authorization header parsers.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface AuthorizationHeaderParserInterface
{
	/**
	 * Gets the parsed authorization header.
	 * @return null|ParsedAuthorizationHeaderInterface Null if no authorization header has been found, the parsed authorization header otherwise.
	 */
	public function parse(): ?ParsedAuthorizationHeaderInterface;
}

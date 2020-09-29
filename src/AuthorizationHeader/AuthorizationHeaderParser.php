<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\AuthorizationHeader;

use function apache_request_headers;
use function array_key_exists;
use function array_slice;
use function implode;

/**
 * Represents an authorization header parser.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class AuthorizationHeaderParser implements AuthorizationHeaderParserInterface
{
	/**
	 * @inheritDoc
	 */
	public function parse(): ?ParsedAuthorizationHeaderInterface
	{
		$headers = apache_request_headers();

		if ( false === array_key_exists( 'Authorization', $headers ) )
		{
			return null;
		}

		$splittedHeaderValue = explode( ' ', $headers[ 'Authorization' ] );

		if ( 1 === count( $splittedHeaderValue ) )
		{
			return null;
		}

		return new ParsedAuthorizationHeader(
			$splittedHeaderValue[ 0 ],
			implode(
				' ',
				array_slice( $splittedHeaderValue, 1 )
			)
		);
	}
}

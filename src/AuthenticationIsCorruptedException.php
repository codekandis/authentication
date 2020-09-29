<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use RuntimeException;

/**
 * Represents the exception if the authentication is corrupted.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class AuthenticationIsCorruptedException extends RuntimeException
{
}

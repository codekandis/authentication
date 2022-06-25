<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use LogicException;

/**
 * Represents an exception if no LDAP connector has been provided.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class NoLdapConnectorProvidedException extends LogicException
{
}

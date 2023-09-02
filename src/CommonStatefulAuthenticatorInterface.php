<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all common stateful authenticators.
 * A stateful authenticator persists the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface CommonStatefulAuthenticatorInterface extends StatefulAuthenticatorInterface, CommonStatelessAuthenticatorInterface
{
}

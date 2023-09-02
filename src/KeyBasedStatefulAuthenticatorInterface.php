<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

/**
 * Represents the interface of all key based stateful authenticators.
 * A key based authenticator is based on clients providing a key.
 * A stateful authenticator persists the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
interface KeyBasedStatefulAuthenticatorInterface extends StatefulAuthenticatorInterface, KeyBasedStatelessAuthenticatorInterface
{
}

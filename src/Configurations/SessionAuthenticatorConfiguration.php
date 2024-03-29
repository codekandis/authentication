<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\Configurations;

/**
 * Represents a session authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class SessionAuthenticatorConfiguration implements SessionAuthenticatorConfigurationInterface
{
	use SessionAuthenticatorConfigurationTrait;
}

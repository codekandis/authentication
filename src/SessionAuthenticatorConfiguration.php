<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Configurations\AbstractConfiguration;

/**
 * Represents a common session authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class SessionAuthenticatorConfiguration extends AbstractConfiguration implements SessionAuthenticatorConfigurationInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function getRegisteredClientSessionKey(): string
	{
		return $this->read( 'registeredClientSessionKey' );
	}
}

<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Authentication\Configurations\SessionAuthenticatorConfigurationInterface;
use CodeKandis\Session\SessionHandlerInterface;

/**
 * Represents the base class of any stateful authenticator based on a session.
 * A stateful authenticator persists the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractSessionAuthenticator implements StatefulAuthenticatorInterface, SessionAuthenticatorInterface
{
	use SessionAuthenticatorTrait;

	/**
	 * Represents the error message if a session key does not exist.
	 * @var string
	 */
	protected const ERROR_SESSION_KEY_DOES_NOT_EXIST = 'The session key \'%s\' does not exist in the session.';

	/**
	 * Constructor method.
	 * @param SessionAuthenticatorConfigurationInterface $configuration The configuration of the session authenticator.
	 * @param SessionHandlerInterface $sessionHandler The session handler the authentication adapter is based on.
	 * @param RegisteredClientInterface $registeredClientDefault The default registered client for authentication initialization.
	 */
	public function __construct( SessionAuthenticatorConfigurationInterface $configuration, SessionHandlerInterface $sessionHandler, RegisteredClientInterface $registeredClientDefault )
	{
		$this->configuration           = $configuration;
		$this->sessionHandler          = $sessionHandler;
		$this->registeredClientDefault = $registeredClientDefault;

		$this->initialize();
	}
}

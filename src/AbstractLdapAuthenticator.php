<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication;

use CodeKandis\Authentication\Configurations\LdapAuthenticatorConfigurationInterface;
use CodeKandis\Ldap\Credentials\LdapClientCredentials as OriginLdapClientCredentials;
use CodeKandis\Ldap\LdapConnectionBindingFailedException;
use CodeKandis\Ldap\LdapConnector;
use CodeKandis\Ldap\LdapConnectorInterface;
use CodeKandis\Ldap\Search\Filters\LdapSearchComparisonEqualToFilter;
use CodeKandis\Ldap\Search\Filters\LdapSearchLogicalAndOperatorFilter;

/**
 * Represents the base class of any LDAP authenticator.
 * An LDAP authenticator is based on clients providing an ID and a passcode.
 * A stateless authenticator does not store the clients' permission.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractLdapAuthenticator implements LdapStatelessAuthenticatorInterface
{
	/**
	 * Stores the configuration of the LDAP authenticator.
	 * @var LdapAuthenticatorConfigurationInterface
	 */
	private LdapAuthenticatorConfigurationInterface $configuration;

	/**
	 * Stores the session key storing the registered client.
	 */
	protected LdapConnector $ldapConnector;

	/**
	 * Constructor method.
	 * @param LdapAuthenticatorConfigurationInterface $configuration The configuration of the LDAP authenticator.
	 * @param LdapConnectorInterface $ldapConnector The LDAP connector to be used for authentication.
	 */
	public function __construct( LdapAuthenticatorConfigurationInterface $configuration, LdapConnectorInterface $ldapConnector )
	{
		$this->configuration = $configuration;
		$this->ldapConnector = $ldapConnector;
	}

	/**
	 * Authenticates the client.
	 * @param LdapClientCredentialsInterface $clientCredentials The credentials of the client to be authenticated.
	 * @return bool True if the client has been authenticated, false otherwise.
	 */
	protected function authenticate( LdapClientCredentialsInterface $clientCredentials ): bool
	{
		try
		{
			$this->ldapConnector->authenticate(
				new OriginLdapClientCredentials(
					$clientCredentials->getId(),
					$clientCredentials->getPassCode()
				)
			);
		}
		catch ( LdapConnectionBindingFailedException $exception )
		{
			return false;
		}

		$permittedLdapGroup = $this->configuration->getPermittedLdapGroup();

		if ( null === $permittedLdapGroup )
		{
			return true;
		}

		$ldapEntry = $this->ldapConnector->searchFirst(
			( new LdapSearchLogicalAndOperatorFilter(
				new LdapSearchComparisonEqualToFilter( 'ObjectClass', 'User' ),
				new LdapSearchComparisonEqualToFilter(
					'SamAccountName',
					$clientCredentials->getId()
				),
			) )
				->getFilterString(),
			false,
			null,
			[
				'DN'
			]
		);

		return true === $this->ldapConnector->isInGroup( $ldapEntry, $permittedLdapGroup );
	}
}

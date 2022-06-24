<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\Configurations;

/**
 * Represents the trait of an LDAP authenticator configuration.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
trait LdapAuthenticatorConfigurationTrait
{
	/**
	 * Stores the session key used to store the registered client.
	 * @var string
	 */
	private string $permittedLdapGroup = '';

	/**
	 * @inheritDoc
	 */
	public function getPermittedLdapGroup(): string
	{
		return $this->permittedLdapGroup;
	}

	/**
	 * Sets the permitted LDAP group all clients must be a member of.
	 * @param string $permittedLdapGroup The permitted LDAP group all clients must be a member of.
	 */
	public function setPermittedLdapGroup( string $permittedLdapGroup ): void
	{
		$this->permittedLdapGroup = $permittedLdapGroup;
	}
}

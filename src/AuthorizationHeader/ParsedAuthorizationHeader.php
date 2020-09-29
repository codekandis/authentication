<?php declare( strict_types = 1 );
namespace CodeKandis\Authentication\AuthorizationHeader;

/**
 * Represents a parsed authorization header.
 * @package codekandis/authentication
 * @author Christian Ramelow <info@codekandis.net>
 */
class ParsedAuthorizationHeader implements ParsedAuthorizationHeaderInterface
{
	/**
	 * Stores the type of the authorization.
	 * @var string
	 */
	private string $type;

	/**
	 * Stores the value of the authorization.
	 * @var string
	 */
	private string $value;

	/**
	 * Constructor method.
	 * @param string $type The type of the authorization.
	 * @param string $value The value of the authorization.
	 */
	public function __construct( string $type, string $value )
	{
		$this->type  = $type;
		$this->value = $value;
	}

	/**
	 * @inheritDoc
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @inheritDoc
	 */
	public function getValue(): string
	{
		return $this->value;
	}
}

<?php


namespace App\Domain\Common;


use App\Domain\Exception\ValidationException;
use Assert\Assertion;
use Assert\AssertionFailedException;

class PersonalName implements ValueObject
{

  protected string $firstname;
  protected string $lastname;

  /**
   * PersonalName constructor.
   * @param string $firstname
   * @param string $lastname
   */
  public function __construct(string $firstname, string $lastname)
  {
    $this->firstname = $firstname;
    $this->lastname = $lastname;
  }

  public function getValue(): string
  {
    return "{$this->firstname} {$this->lastname}";
  }

  /**
   * @param string $firstname
   * @param string $lastname
   * @return PersonalName
   * @throws ValidationException
   */
  public static function of(string $firstname, string $lastname): PersonalName
  {
    try {
      Assertion::notBlank($firstname);
    } catch (AssertionFailedException $e) {
      throw new ValidationException($firstname, $e->getMessage());
    }
    return new PersonalName($firstname, $lastname);
  }
}

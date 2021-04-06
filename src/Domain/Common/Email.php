<?php


namespace App\Domain\Common;

use App\Domain\Exception\ValidationException;
use Assert\Assertion;
use Assert\AssertionFailedException;

class Email extends StringValueObject
{
  /**
   * @param string $value
   * @return Email
   * @throws ValidationException
   */
  public static function of(string $value): Email
  {
    try {
      Assertion::email($value);
    } catch (AssertionFailedException $e) {
      throw new ValidationException($value, $e->getMessage());
    }
    return new Email($value);
  }
}

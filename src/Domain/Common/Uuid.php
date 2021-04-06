<?php


namespace App\Domain\Common;

use App\Domain\Exception\ValidationException;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Ramsey\Uuid\Uuid as UuidV4;

class Uuid extends StringValueObject
{

  public static function generate(): Uuid
  {
    return self::of(UuidV4::uuid4());
  }

  /**
   * @param string $value
   * @return Uuid
   * @throws ValidationException
   */
  public static function of(string $value): Uuid
  {
    try {
      Assertion::uuid($value);
    } catch (AssertionFailedException $e) {
      throw new ValidationException($value, $e->getMessage());
    }

    return new Uuid($value);
  }
}

<?php


namespace App\Domain\Common;


abstract class StringValueObject implements ValueObject
{

  protected string $value;

  /**
   * StringValueObject constructor.
   * @param string $value
   */
  protected function __construct(string $value)
  {
    $this->value = $value;
  }

  public function getValue(): string
  {
    return $this->value;
  }

  abstract public static function of(string $value): StringValueObject;

}

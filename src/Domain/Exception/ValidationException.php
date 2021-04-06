<?php


namespace App\Domain\Exception;


use Exception;

class ValidationException extends Exception
{
  const ERROR_CODE = 400;

  protected string $fieldName;
  protected string $validationMessage;

  /**
   * ValidationException constructor.
   * @param string $value
   * @param string $validationMessage
   * @param Exception|null $previous
   */
  public function __construct(string $value, string $validationMessage, Exception $previous = null)
  {
    parent::__construct("{$value}: {$validationMessage}", static::ERROR_CODE, $previous);
    $this->fieldName = $value;
    $this->validationMessage = $validationMessage;
  }

  public function __toString(): string
  {
    return __CLASS__.": [{$this->fieldName}]: {$this->validationMessage}\n";
  }

}

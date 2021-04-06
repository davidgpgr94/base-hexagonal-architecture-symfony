<?php


namespace App\Domain\Neighbour;

use App\Domain\Common\Uuid;

class NeighbourId extends Uuid
{
  public static function generate(): NeighbourId
  {
    return self::of(parent::generate());
  }

  public static function of(string $value): NeighbourId
  {
    return new NeighbourId(parent::of($value));
  }
}

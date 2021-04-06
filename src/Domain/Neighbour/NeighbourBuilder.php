<?php


namespace App\Domain\Neighbour;


use App\Domain\Common\Email;
use App\Domain\Common\PersonalName;

class NeighbourBuilder
{

  private Neighbour $neighbour;

  /**
   * NeighbourBuilder constructor.
   * @param NeighbourId|null $id
   */
  public function __construct(?NeighbourId $id = null)
  {
    $this->neighbour = new Neighbour();
    if (!is_null($id)) {
      $this->neighbour->setId(NeighbourId::of($id));
    }
  }

  public function id(NeighbourId $id): NeighbourBuilder
  {
    $this->neighbour->setId($id);
    return $this;
  }

  public function email(Email $email): NeighbourBuilder
  {
    $this->neighbour->setEmail($email);
    return $this;
  }

  public function personalName(PersonalName $personalName): NeighbourBuilder
  {
    $this->neighbour->setName($personalName);
    return $this;
  }

  public function build(): Neighbour
  {
    return $this->neighbour;
  }
}

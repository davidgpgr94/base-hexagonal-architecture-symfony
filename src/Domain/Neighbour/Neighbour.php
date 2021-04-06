<?php


namespace App\Domain\Neighbour;


use App\Domain\Common\Email;
use App\Domain\Common\PersonalName;

class Neighbour
{

  private NeighbourId $id;
  private Email $email;
  private PersonalName $name;

  /**
   * @return NeighbourId
   */
  public function getId(): NeighbourId
  {
    return $this->id;
  }

  /**
   * @param NeighbourId $id
   */
  public function setId(NeighbourId $id): void
  {
    $this->id = $id;
  }

  /**
   * @return Email
   */
  public function getEmail(): Email
  {
    return $this->email;
  }

  /**
   * @param Email $email
   */
  public function setEmail(Email $email): void
  {
    $this->email = $email;
  }

  /**
   * @return PersonalName
   */
  public function getName(): PersonalName
  {
    return $this->name;
  }

  /**
   * @param PersonalName $name
   */
  public function setName(PersonalName $name): void
  {
    $this->name = $name;
  }

  /**
   * @param NeighbourId|null $id
   * @return NeighbourBuilder
   */
  public static function builder(?NeighbourId $id = null): NeighbourBuilder
  {
    return new NeighbourBuilder($id);
  }

}

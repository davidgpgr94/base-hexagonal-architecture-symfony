<?php


namespace App\Infrastructure\Adapters;


use App\Domain\Common\Email;
use App\Domain\Neighbour\Neighbour;
use App\Domain\Neighbour\NeighbourCollection;
use App\Domain\Neighbour\NeighbourId;
use App\Application\Ports\NeighbourRepository;

class InMemoryNeighbourRepository implements NeighbourRepository
{

  /**
   * @var Neighbour[]
   */
  private array $neighbours = [];

  public function findById(NeighbourId $id): Neighbour
  {
    return $this->neighbours[$id->getValue()];
  }

  public function findByEmail(Email $email): Neighbour
  {
    $neighbour = array_filter($this->neighbours, function ($neighbour, $id) use ($email) {
      return $neighbour->getEmail()->getValue() === $email->getValue();
    }, ARRAY_FILTER_USE_BOTH);
    return $neighbour[0];
  }

  public function save(Neighbour $neighbour): NeighbourId
  {
    if (is_null($neighbour->getId())) {
      $neighbour->setId(NeighbourId::generate());
    }
    $this->neighbours[$neighbour->getId()->getValue()] = $neighbour;
    return $neighbour->getId();
  }

  public function findAll(): NeighbourCollection
  {
    return new NeighbourCollection(array_values($this->neighbours));
  }
}

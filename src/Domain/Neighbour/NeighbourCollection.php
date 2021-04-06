<?php


namespace App\Domain\Neighbour;


class NeighbourCollection
{

  /**
   * @var Neighbour[]
   */
  private array $neighbours;

  /**
   * NeighbourCollection constructor.
   * @param $neighbours
   */
  public function __construct(array $neighbours = [])
  {
    $this->setNeighbours($neighbours);
  }

  public function addNeighbour(Neighbour $neighbour)
  {
    $this->neighbours[$neighbour->getEmail()->getValue()] = $neighbour;
  }

  public function setNeighbours(array $neighbours)
  {
    $this->neighbours = [];
    foreach ($neighbours as $neighbour) {
      $this->addNeighbour($neighbour);
    }
  }

  /**
   * @return Neighbour[]
   */
  public function getAll(): array
  {
    return array_values($this->neighbours);
  }

  public function getNeighbour(string $email): ?Neighbour
  {
    if (!key_exists($email, $this->neighbours)) {
      return null;
    }
    return $this->neighbours[$email];
  }

  public function getPosition(string $email): ?int
  {
    $position = array_search($email, array_keys($this->neighbours));
    if (false === $position) {
      return null;
    }
    return $position;
  }

  public function getAtPosition(int $position)
  {
    if (count($this->neighbours) <= $position) {
      return null;
    }
    return array_values($this->neighbours)[$position];
  }

  public function count(): int
  {
    return count($this->neighbours);
  }

  public function isEmpty(): bool
  {
    return empty($this->neighbours);
  }

}

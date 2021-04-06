<?php


namespace App\Application\Ports;


use App\Domain\Common\Email;
use App\Domain\Neighbour\Neighbour;
use App\Domain\Neighbour\NeighbourCollection;
use App\Domain\Neighbour\NeighbourId;

interface NeighbourRepository
{

  public function findAll(): NeighbourCollection;

  public function findById(NeighbourId $id): Neighbour;

  public function findByEmail(Email $email): Neighbour;

  public function save(Neighbour $neighbour): NeighbourId;

}

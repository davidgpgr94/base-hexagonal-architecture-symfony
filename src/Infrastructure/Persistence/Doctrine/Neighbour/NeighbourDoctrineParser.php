<?php


namespace App\Infrastructure\Persistence\Doctrine\Neighbour;

use App\Domain\Neighbour\Neighbour;
use \App\Infrastructure\Persistence\Doctrine\Neighbour\Neighbour as NeighbourEntity;

class NeighbourDoctrineParser
{

    public function toDomain(NeighbourEntity $neighbourEntity): Neighbour
    {
        return new Neighbour(
            $neighbourEntity->getId(),
            $neighbourEntity->getEmail(),
            $neighbourEntity->getFirstname(),
            $neighbourEntity->getLastname(),
            $neighbourEntity->getPassword()
        );
    }

    public function toDoctrine(Neighbour $neighbour): NeighbourEntity
    {
        $neighbourEntity = new NeighbourEntity($neighbour->getId(), $neighbour->getEmail());
        $neighbourEntity->setFirstname($neighbour->getFirstname())
            ->setLastname($neighbour->getLastname())
            ->setPassword($neighbour->getPassword());
        return $neighbourEntity;
    }

}
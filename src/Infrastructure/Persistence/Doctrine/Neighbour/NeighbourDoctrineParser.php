<?php


namespace App\Infrastructure\Persistence\Doctrine\Neighbour;

use DateTime;

use App\Domain\Neighbour\Neighbour;
use \App\Infrastructure\Persistence\Doctrine\Neighbour\Neighbour as NeighbourEntity;

class NeighbourDoctrineParser
{

    public function toDomain(NeighbourEntity $neighbourEntity): Neighbour
    {
        $neighbour = new Neighbour(
            $neighbourEntity->getId(),
            $neighbourEntity->getEmail(),
            $neighbourEntity->getFirstname(),
            $neighbourEntity->getLastname(),
            $neighbourEntity->getPassword()
        );
        $neighbour->setCreatedAt($neighbourEntity->getCreatedAt()->getTimestamp())
            ->setUpdatedAt($neighbourEntity->getUpdatedAt()->getTimestamp());
        return $neighbour;
    }

    public function toDoctrine(Neighbour $neighbour): NeighbourEntity
    {
        $neighbourEntity = new NeighbourEntity($neighbour->getId(), $neighbour->getEmail());

        $createdAt = new DateTime();
        $createdAt->setTimestamp($neighbour->getCreatedAt());
        $updatedAt = new DateTime();
        $updatedAt->setTimestamp($neighbour->getUpdatedAt());

        $neighbourEntity->setFirstname($neighbour->getFirstname())
            ->setLastname($neighbour->getLastname())
            ->setPassword($neighbour->getPassword())
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
        return $neighbourEntity;
    }

}
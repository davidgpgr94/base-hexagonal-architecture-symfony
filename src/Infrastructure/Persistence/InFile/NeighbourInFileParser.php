<?php


namespace App\Infrastructure\Persistence\InFile;


use App\Domain\Neighbour\Neighbour;

class NeighbourInFileParser
{

    public function toDomain(string $fileContent): Neighbour
    {
        $neighbourParts = preg_split('/:/', $fileContent);
        $neighbour = new Neighbour($neighbourParts[0], $neighbourParts[1], $neighbourParts[2], $neighbourParts[3], $neighbourParts[4]);
        $neighbour->setCreatedAt(intval($neighbourParts[5]))
            ->setUpdatedAt(intval($neighbourParts[6]));
        return $neighbour;
    }

    public function toInFile(Neighbour $neighbour): string
    {
        return "{$neighbour->getId()}:{$neighbour->getEmail()}:{$neighbour->getFirstname()}:{$neighbour->getLastname()}:{$neighbour->getPassword()}:{$neighbour->getCreatedAt()}:{$neighbour->getUpdatedAt()}";
    }

}
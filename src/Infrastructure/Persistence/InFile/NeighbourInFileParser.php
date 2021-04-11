<?php


namespace App\Infrastructure\Persistence\InFile;


use App\Domain\Neighbour\Neighbour;

class NeighbourInFileParser
{

    public function toDomain(string $fileContent): Neighbour
    {
        $neighbourParts = preg_split('/:/', $fileContent);
        return new Neighbour($neighbourParts[0], $neighbourParts[1], $neighbourParts[2], $neighbourParts[3], $neighbourParts[4]);
    }

    public function toInFile(Neighbour $neighbour): string
    {
        return "{$neighbour->getId()}:{$neighbour->getEmail()}:{$neighbour->getFirstname()}:{$neighbour->getLastname()}:{$neighbour->getPassword()}";
    }

}
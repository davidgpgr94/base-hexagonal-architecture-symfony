<?php


namespace App\Application\Neighbour\CreateNeighbour;


use App\Domain\Neighbour\Neighbour;

class CreateNeighbourResponse
{

    private Neighbour $neighbour;

    /**
     * CreateNeighbourResponse constructor.
     * @param Neighbour $neighbour
     */
    public function __construct(Neighbour $neighbour)
    {
        $this->neighbour = $neighbour;
    }

    /**
     * @return Neighbour
     */
    public function getNeighbour(): Neighbour
    {
        return $this->neighbour;
    }
}
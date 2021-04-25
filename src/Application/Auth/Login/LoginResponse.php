<?php


namespace App\Application\Auth\Login;


use App\Domain\Neighbour\Neighbour;

class LoginResponse
{

    private ?Neighbour $neighbour;

    /**
     * LoginResponse constructor.
     * @param Neighbour|null $neighbour
     */
    public function __construct(?Neighbour $neighbour)
    {
        $this->neighbour = $neighbour;
    }

    /**
     * @return Neighbour|null
     */
    public function getNeighbour(): ?Neighbour
    {
        return $this->neighbour;
    }
}
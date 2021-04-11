<?php


namespace App\Domain\Neighbour\Exceptions;


use Exception;

class NeighbourEmailAlreadyInUse extends Exception
{

    private string $email;

    /**
     * NeighbourEmailAlreadyInUse constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        parent::__construct("The email ".$email." is already in use");
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
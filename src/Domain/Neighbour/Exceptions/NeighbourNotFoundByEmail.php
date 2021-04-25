<?php


namespace App\Domain\Neighbour\Exceptions;

use Exception;

class NeighbourNotFoundByEmail extends Exception
{

    private string $email;

    /**
     * NeighbourNotFoundByEmail constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        parent::__construct("There is no neighbour with the email ".$email);
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
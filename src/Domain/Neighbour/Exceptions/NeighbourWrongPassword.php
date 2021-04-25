<?php


namespace App\Domain\Neighbour\Exceptions;

use Exception;

class NeighbourWrongPassword extends Exception
{
    /**
     * NeighbourWrongPassword constructor.
     */
    public function __construct()
    {
        parent::__construct('Wrong password');
    }
}
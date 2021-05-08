<?php


namespace App\Infrastructure\Api\Response\Neighbour;


use App\Domain\Neighbour\Neighbour;
use App\Infrastructure\Api\Response\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class NeighbourCreatedResponse extends BaseResponse
{

    /**
     * NeighbourCreatedResponse constructor.
     * @param Neighbour $neighbour
     */
    public function __construct(Neighbour $neighbour)
    {
        parent::__construct($neighbour, Response::HTTP_CREATED);
    }
}
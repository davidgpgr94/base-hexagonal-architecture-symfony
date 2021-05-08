<?php


namespace App\Infrastructure\Api\Response\Neighbour;


use App\Infrastructure\Api\Response\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class NeighbourEmailAlreadyInUseResponse extends BaseResponse
{

    /**
     * NeighbourEmailAlreadyInUseResponse constructor.
     * @param string $message
     */
    public function __construct(string $message = 'Email already in use')
    {
        parent::__construct(['message' => $message], Response::HTTP_BAD_REQUEST);
    }
}
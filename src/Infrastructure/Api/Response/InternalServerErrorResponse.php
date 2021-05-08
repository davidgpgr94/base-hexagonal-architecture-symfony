<?php


namespace App\Infrastructure\Api\Response;


use Symfony\Component\HttpFoundation\Response;

class InternalServerErrorResponse extends BaseResponse
{

    /**
     * InternalServerErrorResponse constructor.
     * @param string $message
     */
    public function __construct(string $message = 'Internal server error')
    {
        parent::__construct(['message' => $message], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
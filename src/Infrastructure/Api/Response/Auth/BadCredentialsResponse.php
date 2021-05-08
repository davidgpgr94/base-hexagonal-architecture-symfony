<?php


namespace App\Infrastructure\Api\Response\Auth;


use App\Infrastructure\Api\Response\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class BadCredentialsResponse extends BaseResponse
{

    /**
     * BadCredentialsResponse constructor.
     * @param string $message
     */
    public function __construct($message = 'Bad credentials')
    {
        parent::__construct(['message' => $message, Response::HTTP_BAD_REQUEST]);
    }
}
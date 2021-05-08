<?php


namespace App\Infrastructure\Api\Response\Auth;

use App\Infrastructure\Api\Response\BaseResponse;

class SuccessLoginResponse extends BaseResponse
{
    /**
     * SuccessLoginResponse constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        parent::__construct(['token' => $token]);
    }
}
<?php


namespace App\Infrastructure\Api\Response;


use Symfony\Component\HttpFoundation\Response;

class BaseResponse
{
    private $data;
    private int $status;
    private array $headers;

    /**
     * BaseResponse constructor.
     * @param null $data
     * @param int $status
     * @param array $headers
     */
    public function __construct($data = null, int $status = Response::HTTP_OK, array $headers = [])
    {
        $this->data = $data;
        $this->status = $status;
        $this->headers = $headers;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function addHeader($key, $value): BaseResponse
    {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }


    public function getData()
    {
        return $this->data;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
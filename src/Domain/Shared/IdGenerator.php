<?php


namespace App\Domain\Shared;



class IdGenerator
{

    private $uuidV4;

    /**
     * IdGenerator constructor.
     * @param $uuidV4
     */
    public function __construct($uuidV4)
    {
        $this->uuidV4 = $uuidV4;
    }

    public function generate(): string
    {
        return $this->uuidV4->toString();
    }

}

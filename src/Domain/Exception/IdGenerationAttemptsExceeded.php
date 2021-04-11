<?php


namespace App\Domain\Exception;


use Exception;

class IdGenerationAttemptsExceeded extends Exception
{

    private int $attempts;

    /**
     * IdGenerationTimeout constructor.
     * @param int $attempts
     */
    public function __construct(int $attempts)
    {
        parent::__construct("Exceeded the max number of attempts (".$attempts.") to generate a new id");
        $this->attempts = $attempts;
    }

    /**
     * @return int
     */
    public function getAttempts(): int
    {
        return $this->attempts;
    }
}
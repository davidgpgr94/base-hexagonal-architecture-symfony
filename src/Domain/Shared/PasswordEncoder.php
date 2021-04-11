<?php


namespace App\Domain\Shared;


class PasswordEncoder
{

    /**
     * @param string $rawPassword
     * @return false|string|null
     */
    public function encode(string $rawPassword)
    {
        return password_hash($rawPassword, PASSWORD_BCRYPT);
    }

    public function compare(string $rawPassword, string $encodedPassword): bool
    {
        return password_verify($rawPassword, $encodedPassword);
    }

}
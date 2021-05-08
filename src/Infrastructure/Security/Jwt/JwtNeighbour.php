<?php


namespace App\Infrastructure\Security\Jwt;


use App\Domain\Neighbour\Neighbour;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;

class JwtNeighbour extends Neighbour implements JWTUserInterface
{
    private array $payload;

    /**
     * JwtNeighbour constructor.
     * @param $email
     * @param array $payload
     */
    public function __construct($email, array $payload)
    {
        $this->payload = $payload;
        parent::__construct(
            $payload['id'],
            $email,
            $payload['firstname'],
            $payload['lastname'],
            '');
    }

    /**
     * @param string $username
     * @param array $payload
     * @return JwtNeighbour
     */
    public static function createFromPayload($username, array $payload): JwtNeighbour
    {
        return new self($username, $payload);
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getSalt(): string
    {
        return '';
    }

    public function getUsername(): string
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        $this->setPassword('');
    }
}
<?php


namespace App\Infrastructure\Security\Jwt;


use App\Domain\Neighbour\Neighbour;

class JwtNeighbourParser
{

    public function toDomain(JwtNeighbour $jwtNeighbour): Neighbour
    {
        return new Neighbour(
            $jwtNeighbour->getId(),
            $jwtNeighbour->getUsername(),
            $jwtNeighbour->getFirstname(),
            $jwtNeighbour->getLastname(),
            $jwtNeighbour->getPassword()
        );
    }

    public function toJwtPayload(Neighbour $neighbour): JwtNeighbour
    {
        $payload = [
            'id' => $neighbour->getId(),
            'firstname' => $neighbour->getFirstname(),
            'lastname' => $neighbour->getLastname()
        ];
        return JwtNeighbour::createFromPayload($neighbour->getEmail(), $payload);
    }

}
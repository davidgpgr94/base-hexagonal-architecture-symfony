<?php


namespace App\Domain\Neighbour\Services;


use App\Domain\Neighbour\Neighbour;

interface NeighbourRepository
{

    public function findById(string $id): ?Neighbour;

    public function findByEmail(string $email): ?Neighbour;

    public function save(Neighbour $neighbour): void;

    public function update(Neighbour $neighbour): void;

}
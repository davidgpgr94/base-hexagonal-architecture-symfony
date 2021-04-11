<?php


namespace App\Infrastructure\Persistence\InFile;


use App\Domain\Neighbour\Neighbour;
use App\Domain\Neighbour\Services\NeighbourRepository;

class NeighbourInFileRepository implements NeighbourRepository
{

    private NeighbourInFileParser $neighbourInFileParser;
    private FilesystemHandler $filesystemHandler;

    /**
     * NeighbourInFileRepository constructor.
     * @param NeighbourInFileParser $neighbourInFileParser
     * @param FilesystemHandler $filesystemHandler
     */
    public function __construct(NeighbourInFileParser $neighbourInFileParser, FilesystemHandler $filesystemHandler)
    {
        $this->neighbourInFileParser = $neighbourInFileParser;
        $this->filesystemHandler = $filesystemHandler;
    }

    public function findById(string $id): ?Neighbour
    {
        $fileContent = $this->filesystemHandler->readFile($id);
        if (is_null($fileContent)) return null;

        return $this->neighbourInFileParser->toDomain($fileContent);
    }

    public function findByEmail(string $email): ?Neighbour
    {
        throw new \Exception('findByEmail not implemented');
    }

    public function save(Neighbour $neighbour): void
    {
        $fileContent = $this->neighbourInFileParser->toInFile($neighbour);
        $this->filesystemHandler->createFile($neighbour->getId(), $fileContent);
    }

    public function update(Neighbour $neighbour): void
    {
        throw new \Exception('update not implemented');
    }
}
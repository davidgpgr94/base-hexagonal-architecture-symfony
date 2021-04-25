<?php


namespace App\Application\Neighbour\CreateNeighbour;


use App\Domain\Exception\IdGenerationAttemptsExceeded;
use App\Domain\Neighbour\Exceptions\NeighbourEmailAlreadyInUse;
use App\Domain\Neighbour\Neighbour;
use App\Domain\Neighbour\Services\NeighbourRepository;
use App\Domain\Shared\IdGenerator;
use App\Domain\Shared\PasswordEncoder;

class CreateNeighbourUseCase
{

    private NeighbourRepository $neighbourRepository;
    private IdGenerator $idGenerator;
    private PasswordEncoder $passwordEncoder;

    /**
     * CreateNeighbourUseCase constructor.
     * @param NeighbourRepository $neighbourRepository
     * @param IdGenerator $idGenerator
     * @param PasswordEncoder $passwordEncoder
     */
    public function __construct(NeighbourRepository $neighbourRepository, IdGenerator $idGenerator, PasswordEncoder $passwordEncoder)
    {
        $this->neighbourRepository = $neighbourRepository;
        $this->idGenerator = $idGenerator;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param CreateNeighbourCommand $command
     * @return CreateNeighbourResponse
     * @throws IdGenerationAttemptsExceeded
     * @throws NeighbourEmailAlreadyInUse
     */
    public function create(CreateNeighbourCommand $command): CreateNeighbourResponse
    {
        $this->ensureEmailIsNotUsed($command->getEmail());
        $encodedPassword = $this->encodePassword($command->getRawPassword());
        $id = $this->generateNeighbourId();

        $neighbour = new Neighbour($id, $command->getEmail(), $command->getFirstname(), $command->getLastname(), $encodedPassword);
        $this->neighbourRepository->save($neighbour);

        return new CreateNeighbourResponse($neighbour);
    }

    /**
     * @return string
     * @throws IdGenerationAttemptsExceeded
     */
    private function generateNeighbourId(): string
    {
        $maxAttempts = 5;
        $attempts = 0;
        $id = $this->idGenerator->generate();

        while ($attempts < $maxAttempts && !is_null($this->neighbourRepository->findById($id))) {
            $id = $this->idGenerator->generate();
            $attempts++;
            if ($attempts >= $maxAttempts) {
                throw new IdGenerationAttemptsExceeded($maxAttempts);
            }
        }

        return $id;
    }

    private function encodePassword(string $rawPassword)
    {
        return $this->passwordEncoder->encode($rawPassword);
    }

    /**
     * @param string $email
     * @throws NeighbourEmailAlreadyInUse
     */
    private function ensureEmailIsNotUsed(string $email)
    {
        $neighbourWithSameEmail = $this->neighbourRepository->findByEmail($email);
        if (!is_null($neighbourWithSameEmail)) {
            throw new NeighbourEmailAlreadyInUse($email);
        }
    }

}
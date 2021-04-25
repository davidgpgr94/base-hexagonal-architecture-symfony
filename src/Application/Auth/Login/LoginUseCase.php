<?php


namespace App\Application\Auth\Login;


use App\Domain\Neighbour\Exceptions\NeighbourNotFoundByEmail;
use App\Domain\Neighbour\Exceptions\NeighbourWrongPassword;
use App\Domain\Neighbour\Neighbour;
use App\Domain\Neighbour\Services\NeighbourRepository;
use App\Domain\Shared\PasswordEncoder;

class LoginUseCase
{

    private NeighbourRepository $neighbourRepository;
    private PasswordEncoder $passwordEncoder;

    /**
     * LoginUseCase constructor.
     * @param NeighbourRepository $neighbourRepository
     * @param PasswordEncoder $passwordEncoder
     */
    public function __construct(NeighbourRepository $neighbourRepository, PasswordEncoder $passwordEncoder)
    {
        $this->neighbourRepository = $neighbourRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param LoginCommand $command
     * @return LoginResponse
     * @throws NeighbourNotFoundByEmail
     * @throws NeighbourWrongPassword
     */
    public function login(LoginCommand $command): LoginResponse
    {
        $neighbour = $this->findNeighbourByEmail($command->getEmail());
        $this->ensureNeighbourExists($command->getEmail(), $neighbour);
        $this->ensurePasswordsMatch($command->getPassword(), $neighbour->getPassword());

        return new LoginResponse($neighbour);
    }

    private function findNeighbourByEmail(string $email): ?Neighbour
    {
        return $this->neighbourRepository->findByEmail($email);
    }

    /**
     * @param string $email
     * @param Neighbour|null $neighbour
     * @throws NeighbourNotFoundByEmail
     */
    private function ensureNeighbourExists(string $email, ?Neighbour $neighbour)
    {
        if (is_null($neighbour)) {
            throw new NeighbourNotFoundByEmail($email);
        }
    }

    /**
     * @param string $inputPassword
     * @param string $encodedPassword
     * @throws NeighbourWrongPassword
     */
    private function ensurePasswordsMatch(string $inputPassword, string $encodedPassword)
    {
        $passwordsMatch = $this->passwordEncoder->compare($inputPassword, $encodedPassword);
        if (!$passwordsMatch) {
            throw new NeighbourWrongPassword();
        }
    }
}
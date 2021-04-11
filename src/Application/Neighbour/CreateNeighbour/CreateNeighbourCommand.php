<?php


namespace App\Application\Neighbour\CreateNeighbour;


class CreateNeighbourCommand
{

    private string $email;
    private string $rawPassword;
    private string $firstname;
    private string $lastname;

    /**
     * CreateNeighbourCommand constructor.
     * @param string $email
     * @param string $rawPassword
     * @param string $firstname
     * @param string $lastname
     */
    public function __construct(string $email, string $rawPassword, string $firstname, string $lastname)
    {
        $this->email = $email;
        $this->rawPassword = $rawPassword;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getRawPassword(): string
    {
        return $this->rawPassword;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }
}
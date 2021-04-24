<?php


namespace App\Infrastructure\Persistence\Doctrine\Neighbour;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NeighbourRepository::class)
 */
class Neighbour
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string")
     */
    private string $lastname;

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * Neighbour constructor.
     * @param string $id
     * @param string $email
     */
    public function __construct(string $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Neighbour
     */
    public function setEmail(string $email): Neighbour
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Neighbour
     */
    public function setFirstname(string $firstname): Neighbour
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Neighbour
     */
    public function setLastname(string $lastname): Neighbour
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Neighbour
     */
    public function setPassword(string $password): Neighbour
    {
        $this->password = $password;
        return $this;
    }
}
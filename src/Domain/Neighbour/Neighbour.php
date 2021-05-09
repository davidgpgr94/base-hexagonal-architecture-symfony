<?php


namespace App\Domain\Neighbour;


class Neighbour
{

    private string $id;
    private string $email;
    private string $firstname;
    private string $lastname;
    private string $password;
    private int $createdAt;
    private int $updatedAt;

    /**
     * Neighbour constructor.
     * @param string $id
     * @param string $email
     * @param string $firstname
     * @param string $lastname
     * @param string $password
     */
    public function __construct(string $id, string $email, string $firstname, string $lastname, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = $password;
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
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
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
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
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
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     * @return Neighbour
     */
    public function setCreatedAt(int $createdAt): Neighbour
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): int
    {
        return $this->updatedAt;
    }

    /**
     * @param int $updatedAt
     * @return Neighbour
     */
    public function setUpdatedAt(int $updatedAt): Neighbour
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function setTimestamps()
    {
        $time = new \DateTime('now');
        $this->createdAt = $this->updatedAt = $time->getTimestamp();
    }
    
    public function updateTimestamp()
    {
        $time = new \DateTime('now');
        $this->updatedAt = $time->getTimestamp();
    }

}

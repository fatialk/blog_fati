<?php
namespace App\Entity;
class User
{
    private int $id;
    private string $role;
    private string $name;
    private string $email;
    private string $password;
    private bool $approved;
    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    /**
     * Set the value of password
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    /**
     * Get the value of approved
     */
    public function isApproved(): bool
    {
        return $this->approved;
    }
    /**
     * Set the value of approved
     */
    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;
        return $this;
    }
    /**
     * Get the value of role
     */
    public function getRole(): string
    {
        return $this->role;
    }
    /**
     * Set the value of role
     */
    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }
}

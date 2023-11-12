<?php
namespace App\Entity;
class Comment{
    private int $id;
    private int $userId;
    private int $postId;
    private string $description;
    private string $createdAt;
    private string $updatedAt;
    private bool $approved;
    private User $user;
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
    * Get the value of userId
    */
    public function getUserId(): int
    {
        return $this->userId;
    }
    /**
    * Set the value of userId
    */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }
    /**
    * Get the value of postId
    */
    public function getPostId(): int
    {
        return $this->postId;
    }
    /**
    * Set the value of postId
    */
    public function setPostId(int $postId): self
    {
        $this->postId = $postId;
        return $this;
    }
    /**
    * Get the value of description
    */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
    * Set the value of description
    */
    public function setDescription(string $description): self
    {
        $this->description = $description;
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
     * Get the value of user
     */
    public function getUser(): User
    {
        return $this->user;
    }
    /**
     * Set the value of user
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    /**
     * Set the value of createdAt
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
    /**
     * Set the value of updatedAt
     */
    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}

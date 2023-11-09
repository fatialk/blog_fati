<?php
namespace App\Entity;
use DateTime;


class Post{
    
    private int $id;
    private int $userId;
    private string $title;
    private string $chapo;
    private string $description;
    private string $createdAt;
    private string $updatedAt;
    private User $user;
    private array $comments;
    
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
    * Get the value of title
    */
    public function getTitle(): string
    {
        return $this->title;
    }
    
    /**
    * Set the value of title
    */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        
        return $this;
    }
    
    /**
    * Get the value of chapo
    */
    public function getChapo(): string
    {
        return $this->chapo;
    }
    
    /**
    * Set the value of chapo
    */
    public function setChapo(string $chapo): self
    {
        $this->chapo = $chapo;
        
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
    * Get the value of comments
    */
    public function getComments(): array
    {
        return $this->comments;
    }
    
    /**
    * Set the value of comments
    */
    public function setComments(array $comments): self
    {
        $this->comments = $comments;
        
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
}

?>
<?php
namespace App\Repository;

class PostRepository extends ParentRepository {
     
     public function getPosts()
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("select * from post");
          $this->close();
          $rows = [];
          while ($row = $result->fetch_assoc()) {
               $rows[] = $row;
          }
          
          return $rows;
     }
     
     public function getOnePostById(int $id)
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("select * from post where id=".$id);
          $this->close();
          
          
          return $result->fetch_assoc();
     }
     
     public function createPost (int $userId, string $title, string $image, string $description, string $chapo, string $createdAt, string $updatedAt) {
          
          
          $this->connect('blog_fati');
          $result = $this->conn->query("INSERT INTO post (user_id, title, image, description, chapo, created_at, updated_at) VALUES ('$userId', '$title', '$image', '$description', '$chapo', '$createdAt', '$updatedAt')");
          $this->close();
          
          
          return true;
     }
     
     public function updatePost (int $userId, string $title, string $image, string $description, string $category, string $updatedAt) {
          
          
          $this->connect('blog_fati');
          $result = $this->conn->query("UPDATE post SET user_id = $userId, title = $title, image = $image, description = $description, chapo = $chapo, updated_at = $updatedAt ");
          $this->close();
          
          
          return true;
     }
     
}
?>
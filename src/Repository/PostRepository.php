<?php
namespace App\Repository;
use App\Entity\Post;


class PostRepository extends Database {
     
     public function getPosts()
     {
          $this->connect();
          if (!($stmt = $this->conn->prepare("select * from post"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $stmt->execute();
          $result = $stmt->get_result();
          $this->close();
          $posts = [];
          while ($row = $result->fetch_assoc()) {
               $posts[] = $this->buildObject($row);
          }
          
          return $posts;
     }
     
     public function getOnePostById(int $id)
     {
          $this->connect();
          if (!($stmt = $this->conn->prepare("select * from post where id=?"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $stmt->bind_param("i", $id);
          $stmt->execute();
          $result = $stmt->get_result();
          $this->close();
          $row = $result->fetch_assoc();
          return $this->buildObject($row);
          
     }
     
     public function createPost (Post $post) 
     {
          
          
          $this->connect();
          if (!($stmt = $this->conn->prepare('INSERT INTO post (user_id, title, chapo, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)'))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $userId = $post->getUserId();
          $title = $post->getTitle();
          $description = $post->getDescription();
          $chapo = $post->getChapo();
          $createdAt = $post->getCreatedAt();
          $updatedAt = $post->getUpdatedAt();
          $stmt->bind_param("isssss", $userId, $title, $chapo, $description, $createdAt, $updatedAt);
          $stmt->execute();
          $id = $stmt->insert_id;
          $this->close();
          return $id;
     }
     
     public function updatePost (Post $post) {
          
          
          $this->connect();
          if (!($stmt = $this->conn->prepare('UPDATE post 
          SET user_id = ?, title = ?, chapo = ?, description = ?, updated_at = ? WHERE id = ?'))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $id = $post->getId();
          $userId = $post->getUserId();
          $title = $post->getTitle();
          $description = $post->getDescription();
          $chapo = $post->getChapo();
          $updatedAt = $post->getUpdatedAt();
          $stmt->bind_param("issssi", $userId, $title, $chapo, $description, $updatedAt, $id);
          $stmt->execute();
          $this->close();
          
          
          return true;
     }
     
     public function deletePost (int $id) {
          
          
          $this->connect();
          if (!($stmt = $this->conn->prepare("DELETE FROM post
          WHERE id=?"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $stmt->bind_param("i", $id);
          $stmt->execute();
          $result = $stmt->get_result();
          $this->close();   
          return true;
     }
     
     
     
     private function buildObject(array $row)
     {
          $post = new Post();
          
          $post->setId($row['id']);  
          $post->setUserId($row['user_id']);
          $post->setTitle($row['title']);
          $post->setChapo($row['chapo']);
          $post->setDescription($row['description']);
          $post->setCreatedAt($row['created_at']);  
          $post->setUpdatedAt($row['updated_at']);
          
          return $post;
     }
}
?>
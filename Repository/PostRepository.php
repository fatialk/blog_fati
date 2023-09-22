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
     
     public function createPost (int $userId, string $title, string $image, string $description, string $category) {


          $this->connect('blog_fati');
          $result = $this->conn->query("INSERT INTO post (user_id, title, image, description, category) VALUES ('$userId', '$title', '$image', '$description', '$category')");
          $this->close();
          
          
          return true;
          }
          
}
?>
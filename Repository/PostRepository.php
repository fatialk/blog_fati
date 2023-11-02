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
     
     public function createPost (int $userId, string $title, string $chapo, string $description, string $createdAt, string $updatedAt) {
          
          
          $this->connect('blog_fati');
          $this->conn->query(
          'INSERT INTO post (user_id, title, chapo, description, created_at, updated_at) VALUES ('.$userId.', "'.$title.'", "'.$chapo.'", "'.$description.'", "'.$createdAt.'", "'.$updatedAt.'")');
          $id = $this->conn->insert_id;
          $this->close();
          
          
          return $id;
     }
     
     public function updatePost (int $id, int $userId, string $title, string $description, string $chapo, string $updatedAt) {
          
          
          $this->connect('blog_fati');
          $this->conn->query(
         'UPDATE post 
          SET user_id = '.$userId.', title = "'.$title.'", description = "'.$description.'", chapo = "'.$chapo.'", updated_at = "'.$updatedAt.'"
          WHERE id = '.$id);
          $this->close();
          
          
          return true;
     }

     public function deletePost (int $id) {
          
          
          $this->connect('blog_fati');
          $this->conn->query(
         "DELETE FROM post
          WHERE id = $id");
          $this->close();
          
          
          return true;
     }
     
}
?>
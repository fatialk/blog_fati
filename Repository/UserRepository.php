<?php
namespace App\Repository;

class UserRepository extends ParentRepository {
     
     public function getUsers()
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("select * from user");
          $this->close();
          $rows = [];
          while ($row = $result->fetch_assoc()) {
               $rows[] = $row;
          }
          
          return $rows;
     }
     
     public function getOneUserById(int $id)
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("select name, image from user where id=".$id);
          $this->close();
          
          
          return $result->fetch_assoc();
     }
     
     
     public function createUser (int $postId, string $role, string $name, string $image, string $email, string $password) {
          
          
          $this->connect('blog_fati');
          $result = $this->conn->query("INSERT INTO user (post_id, role, name, image, email, password) VALUES ('$postId', '$role', '$name', '$image', '$email', '$password')");
          $this->close();
          
          
          return true;
     }
     
}
?>
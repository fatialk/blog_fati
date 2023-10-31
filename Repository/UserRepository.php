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
          $result = $this->conn->query("select * from user where id=".$id);
          $this->close();
          
          
          return $result->fetch_assoc();
     }
     
     
     public function createUser (string $role, string $name, string $email, string $password) {
          
          
          $this->connect('blog_fati');
          $result = $this->conn->query
          ("INSERT INTO user (role, name, email, password) VALUES ('$role', '$name', '$email', '$password')");
          $id = $this->conn->insert_id;
          $this->close();
          
          return $id;
     }

     public function getOneUserByEmail(string $email)
     {
          $this->connect('blog_fati');
          $result = $this->conn->query('select * from user where email="'.$email.'"');
          $this->close();
          
          
          return $result->fetch_assoc();
     }
     
     public function viewUsers(int $approved)
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("select * from user where approved=$approved");
          $this->close();
          $rows = [];
          while ($row = $result->fetch_assoc()) {
               $rows[] = $row;
          }

          return $rows;
     }

     public function approveUser(int $id)
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("UPDATE user
          SET approved = true
          WHERE id = $id");
          $this->close();
          
          
          return true;
     }
}
?>
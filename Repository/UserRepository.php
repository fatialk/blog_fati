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

     public function getOneUserByPostId(int $id)
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("select name, image from user where id=".$id);
          $this->close();
          

          return $result->fetch_assoc();
     }
}
?>
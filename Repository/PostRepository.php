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
}
?>
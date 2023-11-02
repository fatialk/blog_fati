<?php
namespace App\Repository;

class CommentRepository extends ParentRepository {

    public function getCommentsByPostId(int $postId, int $approved)
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("select * from comment where post_id=$postId and approved=$approved");
          $this->close();
          $rows = [];
          while ($row = $result->fetch_assoc()) {
               $rows[] = $row;
          }

          return $rows;
     }

     public function createComment(int $userId, int $postId, string $description,string $createdAt, string $updatedAt)
     {
          $this->connect('blog_fati');
          $this->conn->query("INSERT INTO comment (user_id, post_id, description, created_at, updated_at) VALUES ('$userId', '$postId', '$description', '$createdAt', '$updatedAt')");
          $this->close();

          return true;
     }

     public function viewComments(int $approved)
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("select * from comment where approved=$approved");
          $this->close();
          $rows = [];
          while ($row = $result->fetch_assoc()) {
               $rows[] = $row;
          }

          return $rows;
     }

     public function approveComment(int $id)
     {
          $this->connect('blog_fati');
          $this->conn->query("UPDATE comment
          SET approved = true
          WHERE id = $id");
          $this->close();
          
          
          return true;
     }
}
?>
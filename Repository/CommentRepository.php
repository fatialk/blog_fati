<?php
namespace App\Repository;

class CommentRepository extends ParentRepository {

    public function getCommentsByPostId(int $postId)
     {
          $this->connect('blog_fati');
          $result = $this->conn->query("select * from comment where post_id=".$postId);
          $this->close();
          $rows = [];
          while ($row = $result->fetch_assoc()) {
               $rows[] = $row;
          }

          return $rows;
     }
}
?>
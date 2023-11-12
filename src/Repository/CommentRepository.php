<?php
namespace App\Repository;
use App\Entity\Comment;
class CommentRepository extends Database {
     /**
    * la méthode getCommentsByPostId récupère les commentaires
    * approuvés d'un seul article.
    */
     public function getCommentsByPostId(int $postId, int $approved)
     {
          $this->connect();
          if (!($stmt = $this->conn->prepare("select * from comment where post_id=? and approved=?"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $stmt->bind_param("ii", $postId, $approved);
          $stmt->execute();
          $result = $stmt->get_result();
          $this->close();
          $comments = [];
          while ($row = $result->fetch_assoc()) {
               $comments[] = $this->buildObject($row);
          }
          return $comments;
     }
     public function createComment(Comment $comment)
     {
          $this->connect();
          if (!($stmt = $this->conn->prepare("INSERT INTO comment (user_id, post_id, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?)"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $userId = $comment->getUserId();
          $postId = $comment->getPostId();
          $description = $comment->getDescription();
          $createdAt = $comment->getCreatedAt();
          $updatedAt = $comment->getUpdatedAt();
          $stmt->bind_param("iisss", $userId, $postId, $description, $createdAt, $updatedAt);
          $stmt->execute();
          $this->close();
          return true;
     }
     public function viewComments(int $approved)
     {
          $this->connect();
          if (!($stmt = $this->conn->prepare("select * from comment where approved=?"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $stmt->bind_param("i", $approved);
          $stmt->execute();
          $result = $stmt->get_result();
          $this->close();
          $comments = [];
          while ($row = $result->fetch_assoc()) {
               $comments[] = $this->buildObject($row);
          }
          return $comments;
     }
     public function approveComment(int $id)
     {
          $this->connect();
          if (!($stmt = $this->conn->prepare("UPDATE comment SET approved=true WHERE id=?"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $stmt->bind_param("i", $id);
          $stmt->execute();
          $this->close();
          return true;
     }
     private function buildObject(?array $row)
     {
          if(empty($row))
          {
               return null;
          }
          $comment = new Comment();
          $comment->setId($row['id']);
          $comment->setUserId($row['user_id']);
          $comment->setPostId($row['post_id']);
          $comment->setDescription($row['description']);
          $comment->setCreatedAt($row['created_at']);
          $comment->setUpdatedAt($row['updated_at']);
          $comment->setApproved($row['approved']);
          return $comment;
     }
}

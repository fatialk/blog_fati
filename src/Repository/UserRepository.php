<?php
namespace App\Repository;
use App\Entity\User;
class UserRepository extends Database {
     public function getUsers()
     {
          $this->connect();
          if (!($stmt = $this->conn->prepare("select * from user"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $stmt->execute();
          $result = $stmt->get_result();
          $this->close();
          while ($row = $result->fetch_assoc()) {
               $users[] = $this->buildObject($row);
          }
          return $users;
     }
     public function getOneUserById(int $id)
     {
          $this->connect();
          if (!($stmt = $this->conn->prepare("select * from user where id=?"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $stmt->bind_param("i", $id);
          $stmt->execute();
          $result = $stmt->get_result();
          $this->close();
          $row = $result->fetch_assoc();
          return $this->buildObject($row);
     }
     public function createUser (User $user) {
          $this->connect();
          if (!($stmt = $this->conn->prepare('INSERT INTO user (role, name, email, password) VALUES (?, ?, ?, ?)'))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $role = $user->getRole();
          $name = $user->getName();
          $email = $user->getEmail();
          $password = $user->getPassword();
          $stmt->bind_param("ssss", $role, $name, $email, $password);
          $stmt->execute();
          $id = $stmt->insert_id;
          $this->close();
          return $id;
     }
     public function getOneUserByEmail(string $email)
     {
          $this->connect();
          if (!($stmt = $this->conn->prepare("select * from user where email=?"))) {
               echo "Échec lors de la préparation : (" . $this->conn->errno . ") " . $this->conn->error;
          }
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();
          $this->close();
          return $this->buildObject($result->fetch_assoc());
     }
     public function viewUsers(int $approved)
     {
          $this->connect();
          $result = $this->conn->query("select * from user where approved=$approved");
          $this->close();
          $users = [];
          while ($row = $result->fetch_assoc()) {
               $users[] = $this->buildObject($row);
          }
          return $users;
     }
     public function approveUser(int $id)
     {
          $this->connect('blog_fati');
          $this->conn->query("UPDATE user
          SET approved = true
          WHERE id = $id");
          $this->close();
          return true;
     }
     private function buildObject(?array $row)
     {
          if(empty($row))
          {
               return null;
          }
          $user = new User();
          $user->setId($row['id']);
          $user->setRole($row['role']);
          $user->setName($row['name']);
          $user->setEmail($row['email']);
          $user->setPassword($row['password']);
          $user->setApproved($row['approved']);
          return $user;
     }
}

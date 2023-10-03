<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;

class UserController{
    
    private string $viewDir = '/../Views/';
    private string $uploadDir = '/../Upload/User/';

    private function moveUploadedFile(string $filename)
    {
        
        $tmp_name = $_FILES["avatar"]["tmp_name"];
                $extension = pathinfo($_FILES["avatar"]['name'])['extension'];
                $filePath = __DIR__ .$this->uploadDir.$filename.'.'.$extension;
                move_uploaded_file($tmp_name, $filePath);

                return $filePath;
    }
    public function createUserAction(){
        if (empty($_POST['password']) || empty($_POST['confirm-password']) || $_POST['password'] !== $_POST['confirm-password'])
        {
            echo"les données renseignées sont invalides";
            header('Location: /register');
            exit();
        }
        $filePath = $this->moveUploadedFile($_POST['name']);
        $userRepository = new UserRepository();
        $role = 'User';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = hash('sha512' ,$_POST['password']);
        if(empty($name) || empty($email)) 
        { 
            echo"les données renseignées sont invalides";
            header('Location: /register');
            exit();
        }
       
         $user = $userRepository->createUser($role, $name, $filePath, $email, $password);
         header('Location: /signIn');
    }

    
    
    public function authAction(){
        $userRepository = new UserRepository();
        $email = $_POST['email'];
        $password = hash('sha512' ,$_POST['password']);
        $user = $userRepository->getOneUserByEmail($email);
        $_SESSION['status'] = 'not-connected';
        
        if(!empty($user) && $password === $user['password']) {
            $_SESSION['status'] = 'connected';
            $_SESSION['connected-user'] = $user;
           header('Location: /home');
           exit();
        }

        header('Location: /signIn');
        exit();   
    }
}
    
?>
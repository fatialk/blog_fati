<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;



class UserController{
    
    private string $viewDir = '/../Views/';
    public function createUserAction(){
        $userRepository = new UserRepository();
        $postId = $_POST['post_id'];
        $role = $_POST['role'];
        $name = $_POST['name'];
        $image = $_POST['image'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userRepository->createUser($postId, $role, $name, $image, $email, $password);


    }}

    ?>
<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Helper\Helper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class UserController{
    
    private string $viewDir = '/../Views/';
    private string $uploadDir = '../Upload/User/';

   
    public function signInAction(){
        
        $loader = new FilesystemLoader(__DIR__.$this->viewDir);
        $twig = new Environment($loader);

        echo $twig->render('SignIn.html');
    
    }
    
    public function signOutAction(){

        session_destroy();
        header('location: /signIn');
    
    }

    public function registerAction(){
        
        $loader = new FilesystemLoader(__DIR__.$this->viewDir);
        $twig = new Environment($loader);

        echo $twig->render('Register.html');
    
    }


    
    public function createUserAction(){
        if (!isset($_POST['password'], $_POST['confirm-password']) || $_POST['password'] !== $_POST['confirm-password'])
        {
            echo"les données renseignées sont invalides";
            header('Location: /register');
        }else{
            $userRepository = new UserRepository();
            $role = 'User';
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null ;
            $password = hash('sha512' ,$_POST['password'] ?? null);
            if(empty($name) || empty($email))
            {
                echo"les données renseignées sont invalides";
                header('Location: /register');
                exit();
            }

            $userId = $userRepository->createUser($role, $name, $email, $password);
            Helper::moveUploadedFile($userId.'_'.$_POST['name'], 'avatar', $this->uploadDir);
            header('Location: /signIn');
        }
       

    }

    
    /**
     * vérifier si l'email et mdp sont correctes
     */
    public function authAction(){
        $userRepository = new UserRepository();
        $email = $_POST['email'] ?? null;
        $password = hash('sha512' ,$_POST['password'] ?? null);
        $user = $userRepository->getOneUserByEmail($email);

        if(!empty($user) && $password === $user['password']) {

            $_SESSION['connected-user'] = $user;
            header('Location: /home');
        }else{
            header('Location: /signIn');
        }

    }
}
    
?>
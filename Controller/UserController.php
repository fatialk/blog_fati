<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Helper\Helper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class UserController
{

    private string $viewDir = '/../Views/';
    private string $uploadDir = '../Upload/User/';


    public function signInAction()
    {

        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);

        echo $twig->render('SignIn.html');

    }

    public function signOutAction()
    {

        session_write_close();
        header('location: /signIn');

    }

    public function registerAction()
    {

        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);
        echo $twig->render('Register.html');

    }


    public function createUserAction()
    {
        if (!isset($_POST['password'], $_POST['confirm-password'], $_POST['name'], $_POST['email'], $_FILES['avatar']) || $_POST['password'] !== $_POST['confirm-password']) {
            echo "les données renseignées sont invalides";
            header('Location: /register');
            exit();
        }

        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $password = hash('sha512', $password);
        $userRepository = new UserRepository();
        $role = 'User';

        $userId = $userRepository->createUser($role, $name, $email, $password);
        Helper::moveUploadedFile($userId . '_' . $name, 'avatar', $this->uploadDir);
        header('Location: /signIn');
    }


    /**
     * vérifier si l'email et mdp sont correctes
     */
    public function authAction()
    {

        $userRepository = new UserRepository();
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = hash('sha512', $password);
        $user = $userRepository->getOneUserByEmail($email);
        $_SESSION['status'] = 'not-connected';

        if (!empty($user) && $password === $user['password']) {
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
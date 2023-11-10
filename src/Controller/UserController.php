<?php
namespace App\Controller;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Helper\Helper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class UserController
{
    private string $viewDir = '/../../views/';
    private string $uploadDir = '../../public/assets/Upload/User/';
    public function signInAction()
    {
        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);
        echo $twig->render('SignIn.html.twig');
    }
    public function signOutAction()
    {
        session_destroy();
        header('location: /signIn');
    }
    public function registerAction()
    {
        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('Register.html.twig', [
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    public function createUserAction()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /register');
        }
        if (!isset($_POST['password'], $_POST['confirm-password']) || $_POST['password'] !== $_POST['confirm-password']) {
            echo "les données renseignées sont invalides";
            header('Location: /register');
        }
        if (empty($_POST['name']) || empty($_POST['email'])) {
            echo "les données renseignées sont invalides";
            header('Location: /register');
        }
        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $userRepository = new UserRepository();
        $user = new User();
        $user->setRole('User');
        $user->setName($name);
        $user->setEmail(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $user->setPassword(hash('sha512', filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $userId = $userRepository->createUser($user);
        Helper::moveUploadedFile($userId . '_' . $name, 'avatar', $this->uploadDir);
        header('Location: /signIn');
    }
    /**
     * vérifier si l'email et mdp sont correctes
     */
    public function authAction()
    {
        $userRepository = new UserRepository();
        $anonymous = new User();
        $anonymous->setEmail(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $anonymous->setPassword(hash('sha512', filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
        $user = $userRepository->getOneUserByEmail($anonymous->getEmail());
        if (!empty($user) && $anonymous->getPassword() === $user->getPassword()) {
            $_SESSION['connected-user'] = $user;
            header('Location: /home');
        } else {
            header('Location: /signIn');
        }
    }
}

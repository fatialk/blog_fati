<?php
namespace App\Controller;
use App\Entity\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Helper\Helper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
/**
* UserController est le controller de l'espace utilisateur.
*/
class UserController
{
    private string $viewDir = '/../../views/';
    private string $uploadDir = '../../public/assets/Upload/User/';
    /**
    * la méthode getListAction affiche la vue qui permet à l'utilisateur de se connecter à son compte.
    */
    public function signInAction()
    {
        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('SignIn.html.twig', [
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    /**
    * la méthode signOutAction supprime la session de l'utilisateur et le déconnecte.
    */
    public function signOutAction()
    {
        session_destroy();
        header('location: /signIn');
    }
    /**
    * la méthode registerAction affiche la vue qui permet à l'utilisateur de créer un compte.
    */
    public function registerAction()
    {
        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('Register.html.twig', [
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    /**
    * la méthode createUserAction ajoute un utilisateur.
    */
    public function createUserAction()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /signIn');
            return;
        }
        if (!isset($_POST['password'], $_POST['confirm-password']) || $_POST['password'] !== $_POST['confirm-password']) {
            echo "les données renseignées sont invalides";
            header('Location: /register');
            return;
        }
        if (empty($_POST['name']) || empty($_POST['email'])) {
            echo "les données renseignées sont invalides";
            header('Location: /register');
            return;
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
    * la méthode authAction vérifie l'authenticité de l'utilisateur.
    */
    public function authAction()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /signIn');
            return;
        }
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

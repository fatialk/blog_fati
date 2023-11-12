<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use App\Helper\Helper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
/**
* AdminControlle est le controller de l'espace admin.
*/
class AdminController{
    private string $viewDir = __DIR__.'/../../views/';
    /**
    * la méthode postCreateViewAction affiche la vue de création d'un article.
    */
    public function postCreateViewAction()
    {
        $loader = new FilesystemLoader($this->viewDir);
        $twig = new Environment($loader);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('createPost.html.twig', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'contact' => Helper::getContact(),
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    /**
    * la méthode postEditViewAction affiche la vue de modification d'un article.
    */
    public function postEditViewAction(int $id)
    {
        $loader = new FilesystemLoader($this->viewDir);
        $twig = new Environment($loader);
        $postRepository = new PostRepository();
        $post = $postRepository->getOnePostById($id);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('editPost.html.twig', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'post' => $post,
            'contact' => Helper::getContact(),
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    /**
    * la méthode viewCommentsAction affiche la vue d'approbation des commentaires.
    */
    public function viewCommentsAction()
    {
        $loader = new FilesystemLoader($this->viewDir);
        $twig = new Environment($loader);
        $commentRepository = new commentRepository();
        $userRepository = new userRepository();
        $comments = $commentRepository->viewComments(false);
        foreach ($comments as $_=>$comment) {
            $comment->setUser($userRepository->getOneUserById($comment->getUserId()));
        }
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('approveComment.html.twig', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'comments' => $comments,
            'contact' => Helper::getContact(),
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    /**
    * la méthode approveCommentAction permet d'approuver les commentaires.
    */
    public function approveCommentAction()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /signIn');
            return;
        }
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $commentRepository = new CommentRepository();
        $commentRepository->approveComment($id);
        header('Location: /admin/comments/list/view');
    }
    /**
    * la méthode viewUsersAction affiche la vue d'approbation des utilisateurs.
    */
    public function viewUsersAction()
    {
        $loader = new FilesystemLoader($this->viewDir);
        $twig = new Environment($loader);
        $userRepository = new userRepository();
        $users = $userRepository->viewUsers(false);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('approveUser.html.twig', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'users' => $users,
            'contact' => Helper::getContact(),
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    /**
    * la méthode approveUserAction permet d'approuver les utilisateurs.Les utilisateurs approuvés ont ainsi les mêmes droits que les administrateurs
    */
    public function approveUserAction()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /signIn');
            return;
        }
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $userRepository = new UserRepository();
        $userRepository->approveUser($id);
        header('Location: /admin/users/list/view');
    }
}

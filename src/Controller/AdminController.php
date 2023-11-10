<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use App\Helper\Helper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class AdminController{
    private string $viewDir = __DIR__.'/../../views/';
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

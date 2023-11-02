<?php
namespace App\Controller;
use App\Repository\AdminRepository;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use App\Helper\Helper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;




class AdminController{
    
    private string $viewDir = __DIR__.'/../Views/';
    public function postCreateViewAction()
    {
        $loader = new FilesystemLoader($this->viewDir);
        $twig = new Environment($loader);

        echo $twig->render('createPost.html', [
        'connected'=>(!empty($_SESSION['status']) && $_SESSION['status'] === 'connected'),
        'approved' => (isset($_SESSION['connected-user']['approved']) && $_SESSION['connected-user']['approved']),
        // 'approved' => (!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved']),
        'contact' => Helper::getContact()]
    );
        
    }

    public function postEditViewAction(int $id)
    {
        $loader = new FilesystemLoader($this->viewDir);
        $twig = new Environment($loader);
        $postRepository = new PostRepository();
        $post = $postRepository->getOnePostById($id);

        if(empty($post))
        {
            
        }
       
        echo $twig->render('editPost.html', [
            'connected'=>(!empty($_SESSION['status']) && $_SESSION['status'] === 'connected'),
            'approved' => (!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved']),
            'post' => $post,
            'contact' => Helper::getContact()
        ]);

    }

    public function viewCommentsAction()
    {
        $loader = new FilesystemLoader($this->viewDir);
        $twig = new Environment($loader);
        $commentRepository = new commentRepository();
        $userRepository = new userRepository();
        $comments = $commentRepository->viewComments(false);
        foreach ($comments as $key=>$comment) {
            $comments[$key]['user'] = $userRepository->getOneUserById($comment['user_id']);
        }

        echo $twig->render('approveComment.html', [
            'connected'=>(!empty($_SESSION['status']) && $_SESSION['status'] === 'connected'),
            'approved' => (!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved']),
            'comments' => $comments,
            'contact' => Helper::getContact()
        ]);

    }

     public function approveCommentAction()
    {
       
        $id = $_POST['id'];
        $commentRepository = new CommentRepository();    
        $commentApproved = $commentRepository->approveComment($id);
        
        header('Location: /admin/comments/list/view');
        

       

    }

    public function viewUsersAction()
    {
        $loader = new FilesystemLoader($this->viewDir);
        $twig = new Environment($loader);
        $userRepository = new userRepository();
        $users = $userRepository->viewUsers(false);
        

        echo $twig->render('approveUser.html', [
            'connected'=>(!empty($_SESSION['status']) && $_SESSION['status'] === 'connected'),
            'approved' => (!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved']),
            'users' => $users,
            'contact' => Helper::getContact()
        ]);

    }

     public function approveUserAction()
    {
    
        $id = $_POST['id'];
        $userRepository = new UserRepository();    
        $userApproved = $userRepository->approveUser($id);
        
        header('Location: /admin/users/list/view');
        

       

    }
   
}

?>
<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;



class PostController{

    private string $viewDir = '/../Views/';
    public function getListAction()
    {

        $postRepository = new PostRepository();
        $posts = $postRepository->getPosts();
        $_SESSION['posts'] = $posts;
        require __DIR__ . $this->viewDir . 'ListPostView.php';
    }

    public function getOneAction(int $id)
    {

        $postRepository = new PostRepository();
        $post = $postRepository->getOnePostById($id);
        $_SESSION['post'] = $post;

        $commentRepository = new CommentRepository();
        $comments = $commentRepository ->getCommentsByPostId($id);
        $_SESSION['comments'] = $comments;

        $userRepository = new UserRepository();
        $user = $userRepository ->getOneUserByPostId($id);
        $_SESSION['user'] = $user;

        require __DIR__ . $this->viewDir . 'OnePostView.php';

    }
    
}


?>
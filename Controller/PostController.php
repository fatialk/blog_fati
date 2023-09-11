<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;

class PostController{

    private string $viewDir = '/../Views/';
    public function getPostsAction()
    {

        $postRepository = new PostRepository();
        $posts = $postRepository->getPosts();
        $_SESSION['posts'] = $posts;
        require __DIR__ . $this->viewDir . 'PostView.php';
    }
    
}


?>
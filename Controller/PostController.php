<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;



class PostController{
    
    private string $viewDir = '/../Views/';
    public function getListAction()
    {
        $userRepository = new UserRepository();
        $postRepository = new PostRepository();        
        $commentRepository = new CommentRepository();        
        $posts = $postRepository->getPosts();
        foreach ($posts as $key=>$post) {
            $posts[$key]['user'] = $userRepository->getOneUserById($post['user_id']);
            $posts[$key]['comments'] = $commentRepository->getCommentsByPostId($post['id']);
        }
        $_SESSION['posts'] = $posts;
        require __DIR__ . $this->viewDir . 'ListPostView.php';
    }
    
    public function getOneAction(int $id)
    {
        
        $postRepository = new PostRepository();
        $post = $postRepository->getOnePostById($id);
        $_SESSION['post'] = $post;
        $userRepository = new UserRepository();
        $commentRepository = new CommentRepository();
        $comments = $commentRepository->getCommentsByPostId($id);
        foreach ($comments as $key=>$comment) {
            $comments[$key]['user'] = $userRepository->getOneUserById($comment['user_id']);
        }
        
        $userPost = $userRepository->getOneUserById($post['user_id']);
        $_SESSION['user'] = $userPost;
        $_SESSION['comments'] = $comments;
        require __DIR__ . $this->viewDir . 'OnePostView.php';
        
    }
    
    public function createPostAction()
     {
        $postRepository = new PostRepository();
        $userId = 1;
        $title = $_POST['title'];
        $image = $_POST['image'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $post = $postRepository->createPost($userId, $title, $image, $description, $category);

        
    }

    
}


?>
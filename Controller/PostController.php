<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;



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
        $comments = $commentRepository->getCommentsByPostId($id, true);
        foreach ($comments as $key=>$comment) {
            $comments[$key]['user'] = $userRepository->getOneUserById($comment['user_id']);
        }
        
        $userPost = $userRepository->getOneUserById($post['user_id']);
        
        $loader = new FilesystemLoader(__DIR__.'/../Views');
        $twig = new Environment($loader);


        echo $twig->render('onePostView.html', [
           'user'  => $userPost,
           'comments' => $comments,
           'post' => $post
        ]);

        
    }
    
    public function createPostAction()
     {
        $postRepository = new PostRepository();
        $userId = 1;
        $title = $_POST['title'];
        $image = $_POST['image'];
        $description = $_POST['description'];
        $chapo = $_POST['chapo'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');
       
        $post = $postRepository->createPost($userId, $title, $image, $description, $chapo, $createdAt, $updatedAt );
        header('Location: /posts/list');
       
    }

    public function updatePostAction()
     {
        $postRepository = new PostRepository();
        $userId = 1;
        $title = $_POST['title'];
        $image = $_POST['image'];
        $description = $_POST['description'];
        $chapo = $_POST['chapo'];
        $updatedAt = date('Y-m-d H:i:s');
       
        $post = $postRepository->updatePost($userId, $title, $image, $description, $chapo, $updatedAt );
        header('Location: /posts/list');
       
    }

    
}


?>
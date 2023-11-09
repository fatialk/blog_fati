<?php
namespace App\Controller;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Helper\Helper;


class PostController{
    private string $uploadDir = '../../public/assets/Upload/Post/';
    private string $viewDir = '/../../views/';
    public function getListAction()
    {
        $userRepository = new UserRepository();
        $postRepository = new PostRepository();        
        $commentRepository = new CommentRepository();        
        $posts = $postRepository->getPosts();
        foreach ($posts as $key=>$post) {
            $post->setUser($userRepository->getOneUserById($post->getUserId()));
            $post->setComments($commentRepository->getCommentsByPostId($post->getId(), true));
        }
        
        
        $loader = new FilesystemLoader(__DIR__.$this->viewDir);
        $twig = new Environment($loader);
        
        echo $twig->render('ListPostView.html', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'posts' => $posts,
            'contact' => Helper::getContact()
        ]);
        
        
        
        
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
            $comment->setUser($userRepository->getOneUserById($comment->getUserId()));
        }
        
        $userPost = $userRepository->getOneUserById($post->getUserId());
        
        $loader = new FilesystemLoader(__DIR__.$this->viewDir);
        $twig = new Environment($loader);
        
        
        echo $twig->render('onePostView.html', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'user'  => $userPost,
            'comments' => $comments,
            'post' => $post,
            'contact' => Helper::getContact()
        ]);
        
        
    }
    
    public function createPostAction()
    {   
        if(!isset($_POST['title'], $_FILES['image'], $_POST['description'], $_POST['chapo'])) {
            header('Location: /home');
        }
        
        if(empty($_FILES['image']) || empty($_POST['title']) || empty($_POST['description']) || empty($_POST['chapo'])) {
            header('Location: /home');   
        }

        $postRepository = new PostRepository();
        $user = $_SESSION['connected-user'];
        
        $post = new Post();
        $post->setUserId($user->getId());
        $post->setTitle(filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $post->setChapo(filter_var($_POST['chapo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $post->setDescription(filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $post->setCreatedAt(date('Y-m-d H:i:s'));
        $post->setUpdatedAt(date('Y-m-d H:i:s'));
        $postId = $postRepository->createPost($post);
        Helper::moveUploadedFile($postId, 'image', $this->uploadDir);
        header('Location: /posts/list');  
    }
    
    
    public function updatePostAction()
    {
        $postId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        Helper::moveUploadedFile(filter_var($postId, FILTER_SANITIZE_NUMBER_INT), 'image', $this->uploadDir);
        $postRepository = new PostRepository();
        $user = $_SESSION['connected-user'];
        $post = new Post();
        $post->setId($postId);
        $post->setUserId($user->getId());
        $post->setTitle(filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $post->setChapo(filter_var($_POST['chapo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $post->setDescription(filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $post->setUpdatedAt(date('Y-m-d H:i:s'));
        $postRepository->updatePost($post);
        header('Location: /posts/list');
        
    }
    
    public function deletePostAction(int $id)
    {
        $postRepository = new PostRepository();
        $postRepository->deletePost($id);
        header('Location: /posts/list');
        
    }
    
    
}


?>
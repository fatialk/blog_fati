<?php
namespace App\Controller;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Helper\Helper;
/**
* PostController est le controller de l'espace articles.
*/
class PostController{
    private string $uploadDir = '../../public/assets/Upload/Post/';
    private string $viewDir = '/../../views/';
    /**
    * la méthode getListAction affiche la liste de tous les articles créés.
    */
    public function getListAction()
    {
        $userRepository = new UserRepository();
        $postRepository = new PostRepository();
        $commentRepository = new CommentRepository();
        $posts = $postRepository->getPosts();
        foreach ($posts as $_=>$post) {
            $post->setUser($userRepository->getOneUserById($post->getUserId()));
            $post->setComments($commentRepository->getCommentsByPostId($post->getId(), true));
        }
        $loader = new FilesystemLoader(__DIR__.$this->viewDir);
        $twig = new Environment($loader);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('ListPostView.html.twig', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'posts' => $posts,
            'contact' => Helper::getContact(),
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    /**
    * la méthode getOneAction affiche un seul article et ses commentaires approuvés.
    */
    public function getOneAction(int $id)
    {
        $postRepository = new PostRepository();
        $post = $postRepository->getOnePostById($id);
        $_SESSION['post'] = $post;
        $userRepository = new UserRepository();
        $commentRepository = new CommentRepository();
        $comments = $commentRepository->getCommentsByPostId($id, true);
        foreach ($comments as $_=>$comment) {
            $comment->setUser($userRepository->getOneUserById($comment->getUserId()));
        }
        $userPost = $userRepository->getOneUserById($post->getUserId());
        $loader = new FilesystemLoader(__DIR__.$this->viewDir);
        $twig = new Environment($loader);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('onePostView.html.twig', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'user'  => $userPost,
            'comments' => $comments,
            'post' => $post,
            'contact' => Helper::getContact(),
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    /**
    * la méthode createPostAction ajoute un article.
    */
    public function createPostAction()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /signIn');
            return;
        }
        if(!isset($_POST['title'], $_FILES['image'], $_POST['description'], $_POST['chapo'])) {
            header('Location: /home');
            return;
        }
        if(empty($_FILES['image']) || empty($_POST['title']) || empty($_POST['description']) || empty($_POST['chapo'])) {
            header('Location: /home');
            return;
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
    /**
    * la méthode updatePostAction modifie un article.
    */
    public function updatePostAction()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /signIn');
            return;
        }
        if(empty($_FILES['image']) || empty($_POST['title']) || empty($_POST['description']) || empty($_POST['chapo'])) {
            header('Location: /home');
            return;
        }
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
    /**
    * la méthode deletePostAction supprime un article.
    */
    public function deletePostAction(int $id)
    {
        $postRepository = new PostRepository();
        $postRepository->deletePost($id);
        header('Location: /posts/list');
    }
}

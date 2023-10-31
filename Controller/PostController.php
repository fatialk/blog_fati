<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Helper\Helper;


class PostController{
    private string $uploadDir = '../Upload/Post/';
    private string $viewDir = '/../Views/';
    public function getListAction()
    {
        $userRepository = new UserRepository();
        $postRepository = new PostRepository();        
        $commentRepository = new CommentRepository();        
        $posts = $postRepository->getPosts();
        foreach ($posts as $key=>$post) {
            $posts[$key]['user'] = $userRepository->getOneUserById($post['user_id']);
            $posts[$key]['comments'] = $commentRepository->getCommentsByPostId($post['id'], true);
        }
    

        $loader = new FilesystemLoader(__DIR__.$this->viewDir);
        $twig = new Environment($loader);

        echo $twig->render('ListPostView.html', [
            'connected'=>(!empty($_SESSION['status']) && $_SESSION['status'] === 'connected'),
            'approved' => (!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved']),
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
            $comments[$key]['user'] = $userRepository->getOneUserById($comment['user_id']);
        }
        
        $userPost = $userRepository->getOneUserById($post['user_id']);
        
        $loader = new FilesystemLoader(__DIR__.'/../Views');
        $twig = new Environment($loader);


        echo $twig->render('onePostView.html', [
           'connected'=>(!empty($_SESSION['status']) && $_SESSION['status'] === 'connected'),
           'approved' => (!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved']),
           'user'  => $userPost,
           'comments' => $comments,
           'post' => $post,
           'contact' => Helper::getContact()
        ]);

        
    }
    
    public function createPostAction()
     {   
        $filterTitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $filterImage = filter_var($_POST['image'], FILTER_SANITIZE_STRING);
        $filterDescription = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $filterChapo = filter_var($_POST['chapo'], FILTER_SANITIZE_STRING);
        
    //     if(!isset($_POST['title'], $_POST['image'], $_POST['description'], $_POST['chapo'])) {
    //     header('Location: /home');
    //  }
    if(!isset($filterTitle, $filterImage, $filterDescription, $filterChapo)) {
        header('Location: /home');
    }

        $postRepository = new PostRepository();
        $userId = $_SESSION['connected-user']['id'];
        $title = $filterTitle;
        $description = $filterDescription;
        $chapo = $filterChapo;
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');
        

        if(!empty($title) && !empty($description) && !empty($chapo)) {
            
        $postId = $postRepository->createPost($userId, $title, $description, $chapo, $createdAt, $updatedAt );
        $imageName = Helper::moveUploadedFile($postId, 'image', $this->uploadDir);
        header('Location: /posts/list');  
        }
         
    }

    
    public function updatePostAction()
     {
        $filterId = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        $filterTitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $filterImage = filter_var($_POST['image'], FILTER_SANITIZE_STRING);
        $filterDescription = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $filterChapo = filter_var($_POST['chapo'], FILTER_SANITIZE_STRING);
        $imageName = Helper::moveUploadedFile($filterId, 'image', $this->uploadDir);
        $postRepository = new PostRepository();
        $id = $filterId;
        $userId = $_SESSION['connected-user']['id'];
        $title = $filterTitle;
        $description = $filterDescription;
        $chapo = $filterChapo;
        $updatedAt = date('Y-m-d H:i:s');
      
        $post = $postRepository->updatePost($id, $userId, $title, $description, $chapo, $updatedAt );
        header('Location: /posts/list');
       
    }

    public function deletePostAction(int $id)
     {
        $postRepository = new PostRepository();
        $postdeleted = $postRepository->deletePost($id);
        header('Location: /posts/list');
       
    }

    
}


?>
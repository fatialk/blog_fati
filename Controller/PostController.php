<?php

namespace App\Controller;

use App\Helper\Helper;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class PostController
{
private string $uploadDir = '../Upload/Post/';
private string $viewDir = '/../Views/';
    public function getListAction()
    {
        $userRepository = new UserRepository();
        $postRepository = new PostRepository();
        $commentRepository = new CommentRepository();
        $posts = $postRepository->getPosts();
        foreach ($posts as $key => $post) {
            $posts[$key]['user'] = $userRepository->getOneUserById($post['user_id']);
            $posts[$key]['comments'] = $commentRepository->getCommentsByPostId($post['id'], true);
        }


        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);

        echo $twig->render('ListPostView.html', [
            'connected' => filter_var(!empty($_SESSION['status']) && $_SESSION['status'] === 'connected', FILTER_VALIDATE_BOOLEAN),
            'approved' => filter_var(!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved'], FILTER_VALIDATE_BOOLEAN),
            'posts' => filter_var_array($posts),
            'contact' => filter_var_array(Helper::getContact())
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
        foreach ($comments as $key => $comment) {
            $comments[$key]['user'] = $userRepository->getOneUserById($comment['user_id']);
        }

        $userPost = $userRepository->getOneUserById($post['user_id']);

        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $twig = new Environment($loader);


        echo $twig->render('onePostView.html', [
            'connected' => (!empty($_SESSION['status']) && $_SESSION['status'] === 'connected'),
            'approved' => (!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved']),
            'user' => $userPost,
            'comments' => $comments,
            'post' => $post,
            'contact' => Helper::getContact()
        ]);


    }

    public function createPostAction()
    {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $chapo = filter_var($_POST['chapo'], FILTER_SANITIZE_STRING);
        $image = $_FILES['image'];

        if (!isset($title, $image, $description, $chapo)) {
            header('Location: /home');
        }

        $postRepository = new PostRepository();
        $userId = $_SESSION['connected-user']['id'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');


        if (!empty($title) && !empty($description) && !empty($chapo)) {

            $postId = $postRepository->createPost($userId, $title, $description, $chapo, $createdAt, $updatedAt);
            Helper::moveUploadedFile($postId, 'image', $this->uploadDir);
            header('Location: /posts/list');
        }

    }


    public function updatePostAction()
    {
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $chapo = filter_var($_POST['chapo'], FILTER_SANITIZE_STRING);
        $image = $_FILES['image'];
        if (!isset($title, $image, $description, $chapo)) {
            header('Location: /home');
        }
        Helper::moveUploadedFile($id, 'image', $this->uploadDir);
        $postRepository = new PostRepository();
        $userId = $_SESSION['connected-user']['id'];
        $updatedAt = date('Y-m-d H:i:s');

        $postRepository->updatePost($id, $userId, $title, $description, $chapo, $updatedAt);
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
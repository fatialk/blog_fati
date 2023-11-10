<?php
namespace App\Controller;
use App\Entity\Comment;
use App\Repository\CommentRepository;
class CommentController{
    public function createCommentAction() {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /signIn');
            return;
        }
        $commentRepository = new CommentRepository();
        $user = $_SESSION['connected-user'];
        $comment = new Comment;
        $comment->setUserId($user->getId());
        $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
        if (empty($_POST['description'])) {
            echo "les données renseignées sont invalides";
            header('Location: /posts/'.$postId);
            return;
        }
        $comment->setPostId($postId);
        $comment->setDescription(filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $comment->setCreatedAt(date('Y-m-d H:i:s'));
        $comment->setUpdatedAt(date('Y-m-d H:i:s'));
        $commentRepository->createComment($comment);
        header('Location: /posts/'.$postId);
    }
}

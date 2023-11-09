<?php
namespace App\Controller;
use App\Entity\Post;
use App\Entity\Comment;
use App\Repository\CommentRepository;
class CommentController{
    public function createCommentAction() {
        $commentRepository = new CommentRepository();
        $user = $_SESSION['connected-user'];
        $comment = new Comment;
        $comment->setUserId($user->getId());
        $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
        $comment->setPostId($postId);
        $comment->setDescription(filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $comment->setCreatedAt(date('Y-m-d H:i:s'));
        $comment->setUpdatedAt(date('Y-m-d H:i:s'));
        $commentRepository->createComment($comment);
        header('Location: /posts/'.$postId);
    }
}

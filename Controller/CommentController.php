<?php
namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;


class CommentController{
    
    private string $viewDir = '/../Views/';
    public function createCommentAction() {
        $commentRepository = new CommentRepository();
        $userId = $_SESSION['connected-user']['id'] ?? null;
        $postId = $_POST['post_id'] ?? null;
        $description = $_POST['description'] ?? null;
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $commentRepository->createComment($userId, $postId, $description, $createdAt, $updatedAt);
        header('Location: /posts/'.$postId);
    }
}
?>
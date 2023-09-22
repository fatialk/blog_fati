<?php
namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;


class CommentController{
    
    private string $viewDir = '/../Views/';
    public function createCommentAction() {
        $commentRepository = new CommentRepository();
        $userId = 1; 
        $postId = $_POST['post_id'];
        $description = $_POST['description'];
        $commentRepository->createComment($userId, $postId, $description);
        $postController = new PostController();
        $postController->getOneAction($postId);
    }
}
?>
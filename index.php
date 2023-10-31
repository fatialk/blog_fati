<?php
session_start();
require 'vendor/autoload.php';
// On charge le fichier Autoloader
require_once __DIR__ . '/Autoloader.php';
App\Autoloader::register();

use App\Controller\AdminController;
use App\Controller\CommentController;
use App\Controller\DefaultController;
use App\Controller\PostController;
use App\Controller\UserController;

$request = $_SERVER['REQUEST_URI'];
$viewDir = '/Views/';

switch ($request) {

    case '/home':
        $defaultController = new DefaultController();
        $defaultController->homeAction();
        break;
    case '/contact':
        $defaultController = new DefaultController();
        $defaultController->contactAction();
        break;

    case '/posts/list':
        $postController = new PostController();
        $postController->getListAction();
        break;

    case (preg_match("/^\/posts\/\d+$/i", $request) ? true : false) :
        $matches = [];
        preg_match("/^\/posts\/(\d+)$/i", $request, $matches);
        $postController = new PostController();
        $postController->getOneAction($matches[1]);
        break;

    case '/posts/create':
        $postController = new PostController();
        $postController->createPostAction();
        break;

    case '/posts/update':
        $postController = new PostController();
        $postController->updatePostAction();
        break;

    case (preg_match("/^\/posts\/delete\/\d+$/i", $request) ? true : false) :
        $matches = [];
        preg_match("/^\/posts\/delete\/(\d+)$/i", $request, $matches);
        $postController = new PostController();
        $postController->deletePostAction($matches[1]);
        break;

    case '/comments/create':
        $commentController = new CommentController();
        $commentController->createCommentAction();
        break;

    case '/users/create':
        $userController = new UserController();
        $userController->createUserAction();
        break;

    case '/auth':
        $userController = new UserController();
        $userController->authAction();
        break;

    case '/signIn':
        $userController = new UserController();
        $userController->signInAction();
        break;
    case '/signOut':
        $userController = new UserController();
        $userController->signOutAction();
        break;

    case '/register':
        $userController = new UserController();
        $userController->registerAction();
        break;
        break;
    case '/portfolio':
        $defaultController = new DefaultController();
        $defaultController->portfolioAction();
        break;


    case '/admin/post/create/view':
        $adminController = new AdminController();
        $adminController->postCreateViewAction();
        break;


    case (preg_match("/^\/admin\/post\/edit\/view\/\d+$/i", $request) ? true : false) :
        $matches = [];
        preg_match("/^\/admin\/post\/edit\/view\/(\d+)$/i", $request, $matches);
        $adminController = new AdminController();
        $adminController->postEditViewAction($matches[1]);
        break;


    case '/admin/comments/list/view':
        $adminController = new AdminController();
        $adminController->viewCommentsAction();
        break;

    case '/admin/comments/approve':
        $adminController = new AdminController();
        $adminController->approveCommentAction();
        break;

    case '/admin/users/list/view':
        $adminController = new AdminController();
        $adminController->viewUsersAction();
        break;

    case '/admin/users/approve':
        $adminController = new AdminController();
        $adminController->approveUserAction();
        break;

    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';


}

?>
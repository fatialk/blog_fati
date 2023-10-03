<?php
session_start();
// On charge le fichier Autoloader
require_once __DIR__ . '/Autoloader.php';
App\Autoloader::register();

use App\Controller\PostController;
use App\Controller\LoginController;
use App\Controller\CommentController;
use App\Controller\UserController;
$request = $_SERVER['REQUEST_URI'];
$viewDir = '/Views/';

switch ($request) {
    
    case '/home':
        require __DIR__ . $viewDir . 'home.php';
        break;
        
        case '/posts/list':
            $postController = new PostController();
            $postController->getListAction();
            break;
            
            case '/posts/1':
                $postController = new PostController();
                $postController->getOneAction(1);
                break;
                
                case '/posts/3':
                    $postController = new PostController();
                    $postController->getOneAction(3);
                    break;
                    
                    case '/posts/create':
                        $postController = new PostController();
                        $postController->createPostAction();
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
                                        require __DIR__ . $viewDir . 'SignIn.php';
                                        break;
                                        case '/signOut':
                                            session_destroy();
                                            header('location: /signIn');
                                            break;
                                            
                                            case '/register':
                                                require __DIR__ . $viewDir . 'Register.php';
                                                break;
                                                
                                                default:
                                                http_response_code(404);
                                                require __DIR__ . $viewDir . '404.php';
                                                
                                                case '/projects':
                                                    require __DIR__ . $viewDir . 'projects.php';
                                                    break;
                                            
                                            }
                                            
                                            ?>
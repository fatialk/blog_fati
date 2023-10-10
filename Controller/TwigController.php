<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class TwigController{
    
    private string $viewDir = '/../Views/';

    public function twigAction()
    {
        $loader = new FilesystemLoader(__DIR__.'/../Views');
        $twig = new Environment($loader);

        $age = 32;
        echo $twig->render('hello.html', [
            'name' => 'fati',
            'age' =>  $age,
            'loisirs' => ['music', 'sport', 'voyage'],
            'proprietes' => [
                'couleurs' => ['rouge', 'jaune', 'noir'], 
                'formats' => ['rectangle', 'carre', 'cercle']
        ]]);

    


    }
    
}
    
?>
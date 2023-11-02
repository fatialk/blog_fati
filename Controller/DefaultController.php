<?php
namespace App\Controller;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Repository\ContactRepository;
use App\Helper\Helper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class DefaultController{

    private string $viewDir = '/../Views/';
    private string $uploadDir = '../Upload/User/';

    public function homeAction(){
      
        $loader = new FilesystemLoader(__DIR__.$this->viewDir);
        $twig = new Environment($loader);

       

        echo $twig->render('home.html', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'contact' => Helper::getContact()
        
        ]);
    
    }

    public function portfolioAction(){
      
        $loader = new FilesystemLoader(__DIR__.$this->viewDir);
        $twig = new Environment($loader);

        echo $twig->render('portfolio.html', [
            'userConnected'=> isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'contact' => Helper::getContact()
        ]);
    
    }

    public function contactAction(){
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();                            //Send using SMTP
    $mail->Host       = '';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                   //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('', 'Contact-Blog-fati');    //Set email of the sender
    $mail->addAddress('', 'Blog-fati');         //Set email of destination 

    //Content                               //Set email format to HTML
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body = $_POST['message'] .'<br>Nom: '.$_POST['name'] . '<br>Email: '.$_POST['email'];

    $mail->send();
    $_SESSION['contact'] = ['statut'=>'envoyé', 'message' =>'Votre message a été envoyé'];
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    

}
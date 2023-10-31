<?php

namespace App\Controller;

use App\Helper\Helper;
use PHPMailer\PHPMailer\PHPMailer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class DefaultController
{

    private string $viewDir = '/../Views/';
    private string $uploadDir = '../Upload/User/';

    public function homeAction()
    {
        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);

        echo $twig->render('home.html', [
            'connected' => filter_var(!empty($_SESSION['status']) && $_SESSION['status'] === 'connected', FILTER_VALIDATE_BOOLEAN),
            'approved' => filter_var(!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved'], FILTER_VALIDATE_BOOLEAN),
            'contact' => filter_var_array(Helper::getContact())

        ]);

    }

    public function portfolioAction()
    {

        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);

        echo $twig->render('portfolio.html', [
            'connected' => filter_var(!empty($_SESSION['status']) && $_SESSION['status'] === 'connected', FILTER_VALIDATE_BOOLEAN),
            'approved' => filter_var(!empty($_SESSION['connected-user']) && $_SESSION['connected-user']['approved'], FILTER_VALIDATE_BOOLEAN),
            'contact' => filter_var_array(Helper::getContact())
        ]);

    }

    public function contactAction()
    {

        $mail = new PHPMailer(true);
        $mail->isSMTP();                            //Send using SMTP
        $mail->Host = '';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                   //Enable SMTP authentication
        $mail->Username = '';                     //SMTP username
        $mail->Password = '';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('', 'Contact-Blog-fati');    //Set email of the sender
        $mail->addAddress('', '');                 //Set email and name of destination

        //Content                               //Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $mail->Body = filter_var($_POST['message'], FILTER_SANITIZE_STRING) . '<br>Nom: ' . filter_var($_POST['name'], FILTER_SANITIZE_STRING) . '<br>Email: ' . filter_var($_POST['email'], FILTER_SANITIZE_STRING);

        $mail->send();
        $_SESSION['contact'] = ['statut' => 'envoyé', 'message' => 'Votre message a été envoyé'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


}
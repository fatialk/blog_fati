<?php
namespace App\Controller;
use App\Helper\Helper;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use PHPMailer\PHPMailer\PHPMailer;
class DefaultController
{
    private string $viewDir = '/../../views/';
    public function homeAction()
    {
        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('home.html.twig', [
            'userConnected' => isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'contact' => Helper::getContact(),
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    public function portfolioAction()
    {
        $loader = new FilesystemLoader(__DIR__ . $this->viewDir);
        $twig = new Environment($loader);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
        echo $twig->render('portfolio.html.twig', [
            'userConnected' => isset($_SESSION['connected-user']) ? $_SESSION['connected-user'] : null,
            'contact' => Helper::getContact(),
            'csrf_token' => $_SESSION['csrf_token']
        ]);
    }
    public function contactAction()
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /signIn');
            return;
        }
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                        //Send using SMTP
        $mail->Host       = getenv('MAILER_SERVER');                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                               //Enable SMTP authentication
        $mail->Username   = getenv('MAILER_USERNAME');        //SMTP username
        $mail->Password   = getenv('MAILER_PASS');                    //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     //Enable implicit TLS encryption
        $mail->Port       = 587;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom('elachri.fz@alkhalloufi.fr', 'Contact-Blog-fati');    //Set email of the sender
        $mail->addAddress('elachri.fz@gmail.com', 'fatima');                 //Set email of destination
        //Content                                               //Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mail->Body = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . '<br>Nom: ' . filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . '<br>Email: ' . filter_var($_POST['subject'], FILTER_SANITIZE_EMAIL);
        $mail->send();
        $_SESSION['contact'] = ['statut' => 'envoyé', 'message' => 'Votre message a été envoyé'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

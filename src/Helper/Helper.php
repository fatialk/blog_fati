<?php
namespace App\Helper;
class Helper
{   /**
    * la méthode moveUploadedFile renomme et stock
    * les images d'articles et les avatars dans le dossier Upload.
    */
    public static function moveUploadedFile(string $filename, string $imageName, string $uploadDir)
    {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']))
        {
            echo "Attaque csrf";
            header('Location: /signIn');
        }
        $tmp_name = $_FILES[$imageName]["tmp_name"];
        $extension = pathinfo($_FILES[$imageName]['name'])['extension'];
        $filename .= '.' . $extension;
        $filePath = $uploadDir . $filename;
        $filePathAbsolute = __DIR__ . '/' . $filePath;
        move_uploaded_file($tmp_name,  $filePathAbsolute);
        return $filename;
    }

    /**
    *la méthode getContact gère le message de
    *confirmation d'envoi du formulaire de contact et
    *supprime la clé contact dans la variable $_SESSION
    *pour que le message s'affiche qu'une fois.
    */
    public static function getContact()
    {
        $contact = [];
        if (!empty($_SESSION['contact'])) {
            $contact = $_SESSION['contact'];
            unset($_SESSION['contact']);
        }
        return $contact;
    }
}

<?php
namespace App\Helper;




class Helper{
    
    public static function moveUploadedFile(string $filename, string $imageName, string $uploadDir)
    {
                $tmp_name = $_FILES[$imageName]["tmp_name"];
                $extension = pathinfo($_FILES[$imageName]['name'])['extension'];
                $filename .= '.'.$extension;
                $filePath = $uploadDir.$filename;
                $filePathAbsolute = __DIR__.'/'.$filePath;
                move_uploaded_file($tmp_name,  $filePathAbsolute);

                return $filename;
    }

    public static function getContact() {
        $contact = [];
        if(!empty($_SESSION['contact'])){
         $contact = $_SESSION['contact']; 
         unset($_SESSION['contact']);
        }

        return $contact;
    }
}

?>
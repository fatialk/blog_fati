<?php
namespace App;

class Autoloader
{
    
    public static function register()
    {
        spl_autoload_register(
            function($className) {
                $fileName = __DIR__ . '/' .  str_replace('App\\', '/', $className) . ".php";
                if(file_exists($fileName))
                {
                    require_once($fileName);
                }
                else
                {
                    echo "$fileName not found<br>\n";
                }
            }
        );
    }
}

?>
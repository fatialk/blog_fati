<?php

namespace App;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(
            function ($className) {
                $fileName = __DIR__ . '/src/' .  str_replace('App\\', '/', $className) . ".php";
                if (file_exists($fileName)) {
                    require_once($fileName);
                } else {
                    echo htmlspecialchars("$fileName not found<br>\n", ENT_HTML5);
                }
            }
        );
    }
}

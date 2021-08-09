<?php
namespace App;

class Autoloader {

    static function register()
    {
       spl_autoload_register([
           __CLASS__, 'autoload'
        ]);
    }
 
    static function autoload(string $class): void 
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ .'\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/'. $class . '.php';
        }
    }
}
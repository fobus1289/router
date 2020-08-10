<?php

namespace UZB\ROUTER\Init;

class Install
{

    private static $createDir = [
        'app/route',
        'app/config',
        'public'
    ];

    private static $copyFiles = [
        '/route_container.php.o' => 'app/config/route_container.php',
        '/api.php.o' => 'app/route/api.example.php',
        '/.htaccess' => 'example.htaccess',
        '/public/.htaccess' => 'public/example.htaccess',
        '/public/index.php.o' => 'public/index.example.php',
    ];


    public static function run()
    {

        foreach (self::$createDir as $install) {
            @mkdir($install, 0666, true);
        }

        foreach (self::$copyFiles as $key => $value) {
            @copy(__DIR__ . $key, $value);
        }

    }

}

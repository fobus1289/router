<?php

namespace UZB\ROUTER;

final class Configure
{
    public static function configure()
    {
        $server = str_replace('?' . $_SERVER['QUERY_STRING'],
            '', $_SERVER['REQUEST_URI']);

        if (($len = strlen($server)) > 1) {

            if ($server[$len - 1] == '/') {
                $server = rtrim($server, '/');
            }

            if ($server[0] == '/') {
                $server = ltrim($server, '/');
            }

            $_SERVER['REQUEST_URI'] = $server;

        } else {
            $_SERVER['REQUEST_URI'] = '/';
        }

    }

    private static $setting = [];

    public static function &getSetting()
    {
        return self::$setting;
    }

    public static function setting($dir, $container)
    {
        self::$setting = [
            'root' => $dir,
            'container' => $container,
        ];
    }
}

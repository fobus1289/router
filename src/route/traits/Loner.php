<?php

namespace UZB\ROUTER\TRAITS;

trait Loner
{
    private static $object = null;

    public static function instance()
    {
        if (self::$object === null) {
            self::$object = new static();
        }
        return self::$object;
    }

    public static function __callStatic($name, $arguments)
    {

        if (static::valid($arguments[0]) === true) {

            if (self::$currentSchema === null) {
                $current = &self::$classes[$name];
                self::$currentSchema = new $current($arguments[0], self::$result);
            }

            self::$NoSuch = false;

            return self::$currentSchema;

        }

        return static::instance();
    }

    public function __call($name, $arguments)
    {
        return static::instance();
    }

    protected static function valid($req)
    {
        if ($_SERVER['REQUEST_URI'] === $req)
            return true;
        return false;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

}
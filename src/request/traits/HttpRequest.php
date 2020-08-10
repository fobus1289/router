<?php

namespace UZB\ROUTER\TRAITS;

trait HttpRequest
{

    /**
     * @param string $key
     * @return array|mixed
     */
    public final function post($key = null)
    {
        if ($key === null) return $_POST;

        return $_POST[$key];
    }

    public function __get($name)
    {
        $method = &$this->method;

        return $this->$method($name);
    }

    /**
     * @param string $key
     * @return array|mixed
     */
    public final function get($key = null)
    {
        if ($key === null) return $_GET;
        return $_GET[$key];
    }

    /**
     * @param string $key
     * @return array|mixed
     */
    public final function file($key = null)
    {
        if ($key === null) return $_FILES[$key];
        return $_FILES[$key];
    }

    /**
     * @param string $key
     * @return mixed
     */
    public final function input($key = null)
    {
        static $input;

        if ($input == null) {
            $input = file_get_contents('php://input');
            $input = json_decode($input, true);
        }

        if ($key === null) return $input;

        return $input[$key];
    }

}
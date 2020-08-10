<?php

namespace UZB\ROUTER\Base;

trait Validator
{

    function required(string $key): IValidator
    {
        $action = $this->method;

        if (empty($this->$action($key))) {
            $message = $this->message["$key.required"];
            $this->error($message ?? [$key, 'required']);
        }

        return $this;
    }

    function min(string $key, int $value): IValidator
    {
        $action = $this->method;

        $min = $this->$action($key);

        if (strlen($min) < $value) {
            $message = $this->message["$key.min"];
            $this->error($message ?? [$key, 'min']);
        }

        return $this;
    }

    function max(string $key, int $value): IValidator
    {

        $action = $this->method;

        $max = $this->$action($key);

        if (strlen($max) > $value) {
            $message = $this->message["$key.max"];
            $this->error($message ?? [$key, 'max']);
        }

        return $this;
    }

    function isNumber(string $key): IValidator
    {
        $action = $this->method;

        if (!is_numeric($this->$action($key))) {
            $message = $this->message["$key.number"];
            $this->error($message ?? [$key, 'is not number']);
        }
        return $this;
    }

    function confirmation(string $key, string $key2): IValidator
    {

        if ($this->$key !== $this->$key2) {
            $message = $this->message["$key.confirmation"];
            $this->error($message ?? [$key, 'confirmation error']);
        }

    }

}
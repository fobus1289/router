<?php

namespace UZB\ROUTER\Base;

use UZB\ROUTER\TRAITS\HttpRequest;

/**
 * @method void rules(IValidator $validator)
 */
abstract class AbstractRequest  implements IValidator
{
    use HttpRequest, Validator;

    protected string $method;
    protected array $message;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        if (method_exists($this, 'rules')) {
            $this->message = $this->messages();
            $this->rules($this);
        }

    }

    protected function messages()
    {

    }

    protected function error($array)
    {
    }

}
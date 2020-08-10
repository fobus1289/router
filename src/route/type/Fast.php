<?php

namespace UZB\ROUTER\Type;

use UZB\ROUTER\Base\IMiddleWare;
use UZB\ROUTER\Request;
use UZB\ROUTER\TRAITS\Reflect;

class Fast implements IType
{
    use Reflect;

    /**
     * @var $action string|\Closure
     */
    private $action = null;
    private ?string $namespace = null;
    private ?array $middleware = null;
    private ?\Closure $expect = null;
    private ?string $route = null;
    private bool $isDynamic = false;
    private $result = null;

    public function get($action): Fast
    {
        $this->currentMethodValid('GET');

        $this->action = &$action;

        return $this;
    }


    public function post($action): Fast
    {

        $this->currentMethodValid('POST');

        $this->action = &$action;

        return $this;
    }


    public function any($action): Fast
    {
        $this->action = &$action;

        return $this;
    }

    public function middleware(array $array): Fast
    {
        $this->middleware = &$array;
        return $this;
    }

    public function namespace(string $name): Fast
    {
        $this->namespace = &$name;
        return $this;
    }

    public function expect(\Closure $func): Fast
    {
        $this->expect = &$func;
        return $this;
    }

    /**
     *
     * @return $this
     */
    public function dynamic(): Fast
    {
        $this->isDynamic = true;
        return $this;
    }

    private function currentMethodValid(string $method)
    {
        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            throw new \Exception('Method Not Allowed', 405);
        }
    }

    public function done(): void
    {

        if ($this->action instanceof \Closure) {
            $func = &$this->action;
            $this->result = $func();
            return;
        }

        $middleware = &$this->middleware;

        if (!empty($middleware)) {

            foreach ($middleware as $key => $value) {
                /**
                 * @var IMiddleWare $value
                 */
                $value = new $value();
                $value->handle(new Request(), $exeption);
                if ($exeption !== null)
                    throw $exeption;
            }

        }

        if (class_exists($this->namespace)) {
            $class = &$this->namespace;
            $method = &$this->action;
            $init = $this->otherInit();
            $tmp = new $class(...$init['construct']);
            $this->result = $tmp->$method(...$init['method']);
            return;
        }

        throw new \Exception($this->namespace, 500);
    }


    private function otherInit()
    {

        if ($this->expect instanceof \Closure) {
            $func = &$this->expect;
            $array = $func();

            return [
                'construct' => $array['construct'] ?? [],
                'method' => $array['method'] ?? []
            ];

        }

        if ($this->isDynamic === true) {
            return $this->parseClass();
        }

        return [
            'construct' => [],
            'method' => [],
        ];

    }

    public function __construct(string $route, &$result)
    {
        $this->route = $route;
        $this->result = &$result;
    }

}
<?php

namespace UZB\ROUTER\Type;

interface IType
{
    public function get($action): IType;

    public function any($action): IType;

    public function post($action): IType;

    public function middleware(array $array): IType;

    public function namespace(string $name): IType;

    public function expect(\Closure $func): IType;

    public function dynamic(): IType;

    public function done(): void;
}
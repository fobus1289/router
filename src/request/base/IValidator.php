<?php

namespace UZB\ROUTER\Base;

interface IValidator
{
    function required(string $key): IValidator;

    function min(string $key, int $value): IValidator;

    function max(string $key, int $value): IValidator;

    function isNumber(string $key): IValidator;

    function confirmation(string $key,string $key2): IValidator;
}
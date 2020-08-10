<?php

namespace UZB\ROUTER\Base;

use UZB\ROUTER\Request;

interface IMiddleWare
{
    public function handle(Request $request, \Throwable &$exception = null): void;
}

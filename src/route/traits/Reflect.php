<?php

namespace UZB\ROUTER\TRAITS;

trait Reflect
{

    /**
     * @return array
     * @throws \ReflectionException
     */
    protected function parseClass()
    {
        $currentClass = new \ReflectionClass($this->namespace);
        return [
            'construct' => static::parseParams($currentClass->getConstructor()),
            'method' => static::parseParams($currentClass->getMethod($this->action)),
        ];
    }

    private function parseParams($current)
    {
        if ($current == null) return [];

        $result = [];

        $parameters = $current->getParameters();

        foreach ($parameters as $key => $datum) {
            if ($datum->getClass()) {
                $result[$key] = $datum->getClass()->newInstance();
            }
        }

        return $result;
    }

}
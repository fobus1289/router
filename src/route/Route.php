<?php

namespace UZB\ROUTER;

use UZB\ROUTER\Type\IType;
use UZB\ROUTER\TRAITS\Loner;

/**
 * @method static \UZB\ROUTER\Type\Fast fast(string $route)
 */
final class Route
{
    use Loner;

    private static bool $NoSuch = true;
    private static $result = null;
    private static ?IType $currentSchema = null;

    private static array $classes = [
        'fast' => \UZB\ROUTER\Type\Fast::class
    ];

    public static function run(\Closure $callback)
    {
        try {
            $setting = &Configure::getSetting();
            $container = $setting['root'] . $setting['container'];
            $routes = require_once $container;

            foreach ($routes as $route) {
                require_once $setting['root'] . '/' . $route;
            }

            $callback(self::$result, null);

            if (self::$NoSuch === true)
                throw new \Exception('No such route found', 404);
        } catch (\Throwable $exception) {
            $callback(self::$result, $exception);
        }
    }

}

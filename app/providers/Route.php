<?php


namespace App\Providers;

class Route
{
    protected static $router;

    public static function start()
    {
        self::$router = new Router();
    }

    public static function dispatch()
    {
        self::$router->getRoutes()->refreshNameLookups();
        $_ENV['routes'] = self::$router->getRoutes();
        self::$router->dispatch(request());
    }

    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([self::$router, $method], $arguments);
    }

}
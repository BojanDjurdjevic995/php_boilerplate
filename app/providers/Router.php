<?php


namespace App\Providers;

use Illuminate\Routing\Router as MainRouter;

class Router extends MainRouter
{
    public function __construct()
    {
        $events = new Dispatcher();
        parent::__construct($events);
        $this->routes = new RouteCollection();
    }
}
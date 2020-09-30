<?php


namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router as MainRouter;

class Router extends MainRouter
{
    public function __construct()
    {
        $events = new Dispatcher();
        parent::__construct($events);
        $this->routes = new RouteCollection();
        $this->container->instance('Illuminate\Http\Request', request());
    }

    /**
     * Dispatch the request to a route and return the response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function dispatchToRoute(Request $request)
    {
        $route = $this->findRoute($request);
        $this->substituteImplicitBindings($route);
        return $this->runRoute($request, $route);
    }
}
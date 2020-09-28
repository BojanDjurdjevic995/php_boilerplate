<?php


namespace App\Controllers;

use Illuminate\Routing\Redirector as MainRedirector;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;

class Redirector extends MainRedirector
{
    public function __construct()
    {
        $generator = new UrlGenerator($_ENV['routes'], request());
        $session_handler = new SessionHandler();
        $store = new Store('php_session', $session_handler);
        $this->setSession($store);
        parent::__construct($generator);
    }
}
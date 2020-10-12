<?php
    use App\Providers\Route;
    use Illuminate\Support\Str;
    use App\Controllers\Session;
    use Illuminate\Http\Request;
    use App\Controllers\Redirector;
    use Illuminate\Routing\UrlGenerator;
    use Illuminate\Http\Response;

    function timeStamp()
    {
        return date('Y-m-d H:i:s');
    }

    function __include($file, $options = array()){
        foreach ($options as $key => $option)
            ${$key} = $option;
        include base_path('includes/' . $file . '.php');
    }

    if (!function_exists('asset')) {
        function asset($item = '')
        {
            $root = array_filter(explode('/', str_replace('\\', '/', base_path())));
            $lastItem = end($root);
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
            $requestUri = array_filter(explode('/', $_SERVER['REQUEST_URI']));
            $requestUriKey = array_search($lastItem, $requestUri) + 1;
            for ($i = $requestUriKey; $i <= count($requestUri); $i++)
                $requestUri[$i] = '';
            $requestUri = array_filter($requestUri);
            $requestUri =  !empty($requestUri) ? implode('/', $requestUri) . '/' : '';

            $baseUrl = $actual_link . $requestUri;
            return $baseUrl . $item;
        }
    }

    if (!function_exists('base_path')) {
        function base_path($item = '')
        {
            $root_path = dirname(__DIR__) . '/';
            return $root_path . $item;
        }
    }

    if (!function_exists('view_path')) {
        function view_path($view = '')
        {
            return base_path('view/' . $view . '.php');
        }
    }

    if (!function_exists('request')) {
        function request(){
            $r = new Request($_GET, $_POST, [], $_COOKIE, $_FILES, $_SERVER);
            return $r;
        }
    }

    if (!function_exists('redirect')) {
        function redirect(){
            $redirect = new Redirector();
            return $redirect;
        }
    }

    if (!function_exists('session')) {
        function session($name = false, $value = false, $destroy = false) {
            if ($name !== false && $value !== false && !$destroy)
                return Session::set($name, $value);
            else if ($name !== false && $value === false && !$destroy)
                return Session::get($name);
            else if ($name === false && $value === false && !$destroy)
                return Session::get();
            if ($destroy)
                return Session::destroy($destroy);
        }
    }

    if (!function_exists('csrf_token')) {
        function csrf_token() {
            if (!session('_token'))
                session('_token', Str::random(40));
            return session('_token');
        }
    }

    if (!function_exists('csrf_field')) {
        function csrf_field() {
            return '<input type="hidden" name="csrf_token" value="'.csrf_token().'">';
        }
    }

    if (!function_exists('csrf_meta')) {
        function csrf_meta() {
            return '<meta name="csrf-token" content="'.csrf_token().'">';
        }
    }

    if (!function_exists('responseJSON')) {
        function responseJSON($data = array()) {
            echo json_encode($data);
            exit();
        }
    }

    if (!function_exists('response')) {
        function response($data = array(), $status = 200) {
            $r = Response::create($data, $status);
            return $r;
        }
    }

    if (!function_exists('route')) {
        function route($name, $parameters = [], $absolute = true) {
            $uri = new UrlGenerator($_ENV['routes'], request());
            return $uri->route($name, $parameters, $absolute);
        }
    }

    if (!function_exists('is_route')) {
        function is_route($name = '') {
            return Route::currentRouteName() == $name ? true : false;
        }
    }

    if (!function_exists('view')) {
        function view($view, $parameters = []) {
            foreach ($parameters as $key => $value)
                if ($key != 'view')
                    $$key = $value;
                else throw new Exception('Cannot call variable as view', 301);
            include_once view_path($view);
            exit();
        }
    }

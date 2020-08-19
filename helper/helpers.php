<?php
    use App\Controllers\Request;
    use App\Controllers\Redirect;
    use App\Controllers\Session;
    use Illuminate\Support\Str;

    function timeStamp()
    {
        return date('Y-m-d H:i:s');
    }

    function __include($file, $options = array()){
        foreach ($options as $key => $option)
            ${$key} = $option;
        include ROOT_PATH . 'includes/' . $file . '.php';
    }

    if (!function_exists('asset')) {
        function asset($item = '')
        {
            $root = array_filter(explode('/', str_replace('\\', '/', ROOT_PATH)));
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

    if (!function_exists('request')) {
        function request(){
            $r = new Request();
            return $r;
        }
    }

    if (!function_exists('redirect')) {
        function redirect($to = '/', $query = array()){
            Redirect::to($to, $query);
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
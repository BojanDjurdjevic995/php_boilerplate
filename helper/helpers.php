<?php
    use Illuminate\Container\Container;
    function timeStamp()
    {
        return date('Y-m-d H:i:s');
    }

    function __include($file, $options = array()){
        foreach ($options as $key => $option)
            ${$key} = $option;
        include ROOT_PATH . 'includes/' . $file . '.php';
    }

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
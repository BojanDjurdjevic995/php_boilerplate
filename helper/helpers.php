<?php

    function timeStamp()
    {
        return date('Y-m-d H:i:s');
    }

    function asset($item = '')
    {
        return BASE_URL . $item;
    }

    function __include($file, $options = array()){
        foreach ($options as $key => $option)
            ${$key} = $option;
        include ROOT_PATH . 'includes/' . $file . '.php';
    }

//    function env($key, $value = false){
//        if ($value === false)
//            return $_ENV[$key];
//        else return $_ENV[$key] = $value;
//    }
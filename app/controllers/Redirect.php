<?php
namespace App\Controllers;

class Redirect
{
    public static function to($location)
    {
        $url = ($location == '/') ? ('Location: '. BASE_URL) : ('Location: '. BASE_URL . $location .'.php');
        header($url);
        exit();
    }
}
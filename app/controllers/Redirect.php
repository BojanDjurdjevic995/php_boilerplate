<?php
namespace App\Controllers;

use Illuminate\Support\Arr;

class Redirect
{
    public static function to($location, $query = array())
    {

        $url = ($location == '/') ? ('Location: '. asset()) : ('Location: '. asset() . $location .'.php');
        $url .= empty($query) ? '' : '?' . Arr::query($query);
        dd($url);
        header($url);
        exit();
    }
}
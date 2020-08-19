<?php
namespace App\Controllers;
class Request
{
    protected $data;

    public function __construct()
    {
        $this->__get();
    }

    public function __get($varName = false)
    {
        $this->data = (object) [];
        foreach ($_REQUEST as $key => $r)
            $this->data->{$key} = json_decode(json_encode($r));

        if ($varName)
            return isset($this->data->{$varName}) ? $this->data->{$varName} : NULL;
        return $this->data;
    }

    /**
     * This function is checking request method
     * @param $method
     * @return bool
     */
    public static function isMethod($method)
    {
        return (strtoupper($method) == $_SERVER['REQUEST_METHOD']) ? true : false;
    }

    /**
     * This function is check if request is ajax
     * @return bool
     */
    public static function isAjax()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    }
}
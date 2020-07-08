<?php
namespace App\Controllers;
class Session
{
    /**
     * Method check if session exist
     * @param $session
     * @return bool
     */
    public static function exists($session)
    {
        return (isset($_SESSION[$session])) ? true : false;
    }

    /**
     * Method set the new session
     * @param $session
     * @param $value
     * @return bool
     */
    public static function set($session, $value)
    {
        $_SESSION[$session] = $value;
        return true;
    }

    /**
     * Method get session value
     * @param $session
     * @return mixed
     */
    public static function get($session)
    {
        return $_SESSION[$session];
    }

    /**
     * Method delete session
     * @param $session
     */
    public static function destroy($session)
    {
        unset($_SESSION[$session]);
    }
}
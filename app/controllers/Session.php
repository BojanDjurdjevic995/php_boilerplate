<?php

namespace App\Controllers;

class Session
{
    /**
     * Method check if session exist
     * @param $session
     * @return bool
     */
    public static function has($session)
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
    public static function get($session = false)
    {
        if ($session)
            return self::has($session) ? $_SESSION[$session] : NULL;
        return $_SESSION;
    }

    /**
     * Method delete session
     * @param $session
     * @return bool
     */
    public static function destroy($session)
    {
        if (isset($_SESSION[$session]))
            unset($_SESSION[$session]);

        return true;
    }
}
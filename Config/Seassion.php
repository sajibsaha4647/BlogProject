<?php

class Session
{

    public static function init()
    {
        session_start();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public function Destroy()
    {
        session_destroy();
        session_unset();
        header('location: login.php');
    }

    public function checkSession()
    {
        self::init();
        if (self::get("login") == false) {
            self::Destroy();
            header("location:login.php");
        }
    }
}

<?php

class SessionHelper {

    private static function startSession() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function addSession($name, $value) {
        self::startSession();
        $_SESSION[$name] = $value;
    }

    public static function addObject($name, $object) {
        self::startSession();
        $_SESSION[$name] = serialize($object);
    }

    public static function isSession($name) {
        self::startSession();
        if (isset($_SESSION[$name])) {
            return true;
        }
        return false;
    }

    public static function getObject($name) {
        self::startSession();
        if (self::isSession($name)) {
            return unserialize($_SESSION[$name]);
        }
        return false;
    }
    public static function getSession($name) {
        self::startSession();
        if (self::isSession($name)) {
            return $_SESSION[$name];
        }
        return false;
    }

    public static function destroy($name) {
        self::startSession();
        if (self::isSession($name)) {
            unset($_SESSION[$name]);
        }
    }

}

<?php

namespace app\core;

class Session
{
    protected const FLASH_KEY = 'flash_messages';
    public function __constructor()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY];
        foreach ($flashMessages as $key => $flashMessage)
        {
            //mark to be removed
        }
    }
    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = $message;
    }
    public function getFlash($key)
    {

    }
    public function __destruct()
    {
        //interate over marked to be removed and remove
    }
}
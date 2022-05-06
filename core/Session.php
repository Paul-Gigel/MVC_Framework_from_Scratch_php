<?php

namespace app\core;

class Session
{
    protected const FLASH_KEY = 'flash_messages';
    public function __constructor()
    {
        //session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage)
        {
            //mark to be removed
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
    public function setFlash($key, $message)
    {
        //var_dump($_SESSION);
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];

    }
    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }
    public function __destruct()
    {
        var_dump($_SESSION);
        //interate over marked to be removed and remove
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage)
        {
            //mark to be removed
            if ($flashMessage['remove'] = true) {
                unset($flashMessage[$key]);
            }

        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
        var_dump($_SESSION);
    }
}
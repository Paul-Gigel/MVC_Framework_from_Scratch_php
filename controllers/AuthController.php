<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public static function login() {
        return self::render('login');
    }
    public static function register(Request $request)  {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        return self::render('register');
    }
}
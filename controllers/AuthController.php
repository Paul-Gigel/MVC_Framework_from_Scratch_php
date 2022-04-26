<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public static function login() {
        self::setLayout('auth');
        return self::render('login');
    }
    public static function register(Request $request)  {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        self::setLayout('auth');
        return self::render('register');
    }
}
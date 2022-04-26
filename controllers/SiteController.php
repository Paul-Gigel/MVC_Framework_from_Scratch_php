<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public static function home(): string
    {
        $params = [
            'name' => "Paul Gigel"
        ];
        return self::render('home', $params);
    }
    public static function contact(): string
    {
        return self::render('contact');
    }
    public static function handleContact(): string
    {
        return self::render('contact');
    }
}
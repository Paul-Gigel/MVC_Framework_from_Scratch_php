<?php
namespace app\controllers;

use app\core\Application;

class SiteController
{
    public static function home(): string
    {
        $params = [
            'name' => "Paul Gigel"
        ];
        return Application::$app->router->renderView('home', $params);
    }
    public static function contact(): string
    {
        return Application::$app->router->renderView('contact');
    }
    public static function handleContact(): string
    {
        return Application::$app->router->renderView('contact');
    }
}
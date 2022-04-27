<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;

class SiteController extends Controller
{
    public function home(): string
    {
        $params = [
            'name' => "Paul Gigel"
        ];
        return $this->render('home', $params);
    }
    public function contact(): string
    {
        return $this->render('contact');
    }
    public function handleContact(Request $request): string
    {
        $body = $request->getBody();
        var_dump($body);
        return $this->render('contact');
    }
}
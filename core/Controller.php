<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    /**
     * @var \app\core\middlewares\BaseMiddleware[]
     */
    protected $middlewares = [];

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        //var_dump($middleware);
        $this->middlewares = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares ?? [];
    }
}
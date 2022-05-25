<?php

namespace app\core;

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\middlewares\AuthMiddleware;
use app\core\middlewares\BaseMiddleware;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [
       /*
        * 'get' => [
        *     '/' => $callback,
        *     '/contacts' => $callback
        * ],
        * 'post' => [
        *     ...
        * ]
        */
    ];

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false)    {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if (is_string($callback))   {
            return $this->renderView($callback);
        }

        if (is_array($callback))    {
            /**
             * @var Controller $controller
             */
            Application::$app->controller = new $callback[0]();
            Application::$app->controller->action = $callback[1];   //<- da , Problema
            $callback[0] = Application::$app->controller;
            var_dump($callback[0]);
            foreach (Application::$app->controller->getMiddlewares() as $middleware)  {
                $middleware->execute();
            }
            /*
             *
             */
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params =[])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller)
        {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value)   {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}
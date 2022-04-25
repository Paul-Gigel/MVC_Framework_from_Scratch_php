<?php
namespace app\core;
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
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false)    {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if (is_string($callback))   {
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    public function renderView($view)   //$view = $callback
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
        //include_once Application::$ROOT_DIR."/views/$view.php";
    }
    public function renderContent($viewContent)   //$view = $callback
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";
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

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}
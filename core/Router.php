<?php
namespace app\core;
class Router
{
    public Request $request;
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
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        var_dump($method);
    }
}
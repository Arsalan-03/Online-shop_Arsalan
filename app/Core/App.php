<?php

namespace Core;

use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;
use Request\Request;
use Service\AuthenticationService\SessionAuthenticationService;

class App
{
    private array $routes = [

    ];

    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$requestUri])) {

            $requestMethod = $_SERVER['REQUEST_METHOD'];
            $routMethods = $this->routes[$requestUri];

            if (isset($routMethods[$requestMethod])) {
                $handler = $routMethods[$requestMethod];
                $class = $handler['class'];
                $method = $handler['method'];
                $requestClass = $handler['request'] ?? Request::class;

                $authService = new SessionAuthenticationService();

                $obj = new $class($authService);

                $request = new $requestClass($_POST);
                $obj->$method($request);
            } else {
                echo "Метод $requestMethod не поддерживается для $requestUri";
            }
        } else {
            require_once './../View/404.html';
        }
    }

    public function get(string $route, string $class, string $method, string $requestClass = null)
    {
        $this->routes[$route]['GET'] = [
            'class' => $class,
            'method' => $method,
            'request' => $requestClass
        ];
    }
    public function post(string $route, string $class, string $method, string $requestClass = null)
    {
        $this->routes[$route]['POST'] = [
            'class' => $class,
            'method' => $method,
            'request' => $requestClass
        ];
    }

    public function pull(string $route, string $class, string $method, string $requestClass = null)
    {
        $this->routes[$route]['PULL'] = [
            'class' => $class,
            'method' => $method,
            'request' => $requestClass
        ];
    }

    public function delete(string $route, string $class, string $method, string $requestClass = null)
    {
        $this->routes[$route]['DELETE'] = [
            'class' => $class,
            'method' => $method,
            'request' => $requestClass
        ];
    }
}
<?php

namespace Core;

use Request\Request;
use Throwable;

class App
{
    private array $routes = [

    ];

    public function run(): void
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
                $request = new $requestClass($_POST);

                $container = new Container();
                $container->save();

                $obj = $container->get($class);

                try {
                    $obj->$method($request);
                } catch (Throwable $exception) {

                    require_once './../View/505.html';
                }

            } else {
                echo "Метод $requestMethod не поддерживается для $requestUri";
            }
        } else {
            require_once './../View/404.html';
        }
    }

    public function get(string $route, string $class, string $method, string $requestClass = null): void
    {
        $this->routes[$route]['GET'] = [
            'class' => $class,
            'method' => $method,
            'request' => $requestClass
        ];
    }
    public function post(string $route, string $class, string $method, string $requestClass = null): void
    {
        $this->routes[$route]['POST'] = [
            'class' => $class,
            'method' => $method,
            'request' => $requestClass
        ];
    }

    public function pull(string $route, string $class, string $method, string $requestClass = null): void
    {
        $this->routes[$route]['PULL'] = [
            'class' => $class,
            'method' => $method,
            'request' => $requestClass
        ];
    }

    public function delete(string $route, string $class, string $method, string $requestClass = null): void
    {
        $this->routes[$route]['DELETE'] = [
            'class' => $class,
            'method' => $method,
            'request' => $requestClass
        ];
    }
}
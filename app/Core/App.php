<?php

namespace Core;

use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;

class App
{
    private array $routes = [
        '/registrate' => [
            'GET' => [
                'class' => UserController::class,
                'method' => 'getRegistrate',
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'registrate',
            ],
        ],
        '/login' => [
            'GET' => [
                'class' => UserController::class,
                'method' => 'getLogin',
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'login',
            ],
        ],
        '/main' => [
            'GET' => [
                'class' => MainController::class,
                'method' => 'getProducts',
            ],
        ],
        '/cart' => [
            'GET' => [
                'class' => CartController::class,
                'method' => 'getCart',
            ],
        ],
        '/logout' => [
            'POST' => [
                'class' => UserController::class,
                'method' => 'logout',
            ],
        ],
        '/add-product' => [
            'POST' => [
                'class' => ProductController::class,
                'method' => 'addProduct',
            ],
        ],
        '/delete-product' => [
            'POST' => [
                'class' => ProductController::class,
                'method' => 'deleteProduct',
            ],
        ],
        '/order' => [
            'GET' => [
                'class' => OrderController::class,
                'method' => 'getOrders'
            ],
            'POST' => [
                'class' => OrderController::class,
                'method' => 'orders'
            ],
        ],
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

                $obj = new $class;

                $obj->$method($_POST);
            } else {
                echo "Метод $requestMethod не поддерживается для $requestUri";
            }
        } else {
            require_once './../View/404.html';
        }
    }
}
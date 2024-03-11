<?php

namespace Core;

use Controller\CartController;
use Controller\MainController;
use Controller\UserController;

class App
{
    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestUri === '/registrate') {
            $obj = new UserController();
            if ($requestMethod === 'GET') {
                $obj->getRegistrate();
            } elseif ($requestMethod === 'POST') {
                $obj->registrate($_POST);
            } else {
                echo "$requestUri не поддерживает $requestMethod";
            }
        } elseif ($requestUri === '/login') {
            $obj = new UserController();
            if ($requestMethod === 'GET') {
                $obj->getLogin();
            } elseif ($requestMethod === 'POST') {
                $obj->login($_POST);
            } else {
                echo "$requestUri не поддерживает $requestMethod";            }
        } elseif ($requestUri === '/main') {
            $obj = new MainController();
            if ($requestMethod === 'GET') {
                $obj->getProducts();
            } else {
                echo "$requestUri не поддерживает $requestMethod";            }
        } elseif ($requestUri === '/cart') {
            $obj = new CartController();
            if ($requestMethod === 'GET') {
                $obj->getCart();
            } else {
                echo "$requestUri не поддерживает $requestMethod";
            }
        } elseif ($requestUri === '/logout') {
            $obj = new UserController();
            if ($requestMethod === 'POST') {
                $obj->logout();
            }  else {
                echo "$requestUri не поддерживает $requestMethod";
            }
        } elseif ($requestUri === '/add-product') {
            $obj = new MainController();
            if ($requestMethod === 'POST') {
                $obj->addProduct($_POST);
            } else {
                echo "$requestUri не поддерживает $requestMethod";
            }
        } elseif ($requestUri === '/delete-product') {
            $obj = new MainController();
            if ($requestMethod === 'POST') {
                $obj->deleteProduct($_POST);
            } else {
                echo "$requestUri не поддерживает $requestMethod";
            }
        } else {
            require_once "./../View/404.html";
        }
    }
}
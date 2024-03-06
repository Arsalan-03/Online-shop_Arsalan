<?php
use Controller\UserController;
use Controller\MainController;
use Controller\UserProductController;

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

//$autoloaderController = function (string $className)
//{
//    $path =  "./../Controller/$className.php";
//    if (file_exists($path)) {
//        require_once $path;
//
//        return true;
//    }
//    return false;
//}


require_once './../Controller/UserController.php';
require_once './../Controller/MainController.php';
require_once './../Controller/UserProductController.php';

if ($requestUri === '/registrate') {
    $obj = new UserController();
    if ($requestMethod === 'GET') {
        $obj->getRegistrate();
    } elseif ($requestMethod === 'POST') {
        $obj->registrate($_POST);
    } else {
        echo "$requestMethod не поддерживает $requestUri";
    }
} elseif ($requestUri === '/login') {
    $obj = new UserController();
    if ($requestMethod === 'GET') {
        $obj->getLogin();
    } elseif ($requestMethod === 'POST') {
        $obj->login($_POST);
    } else {
        echo "$requestMethod не поддерживает $requestUri";
    }
} elseif ($requestUri === '/main') {
    $obj = new MainController();
    if ($requestMethod === 'GET') {
        $obj->getProducts();
    } else {
        echo "$requestMethod не поддерживает $requestMethod";
    }
} elseif ($requestUri === '/add-product') {
    $obj = new UserProductController();
    if ($requestMethod === 'GET') {
        $obj->getAddProductForm();
    } elseif ($requestMethod === 'POST') {
        $obj->addProduct($_POST);
    } else {
        echo "Метод $requestMethod не поддерживает $requestUri";
    }
} else {
    require_once "./../View/404.html";
}
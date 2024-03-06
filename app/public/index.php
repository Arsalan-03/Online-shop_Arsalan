<?php
use Controller\UserController;
use Controller\MainController;

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$autoloadController = function (string $className) {
    $path =  "./../Controller/$className.php";
    if (file_exists($path)) {
        require_once $path;

        return true;
    }

    return false;
};
$autoloadModel = function (string $className)
{
    $path =  "./../Model/$className.php";
    if (file_exists($path)) {
        require_once $path;

        return true;
    }

    return false;
};

spl_autoload_register($autoloadController);
spl_autoload_register($autoloadModel);


require_once './../Controller/UserController.php';
require_once './../Controller/MainController.php';

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
    } elseif ($requestMethod === 'POST') {
        $obj->addProduct($_POST);
    } else {
        echo "$requestMethod не поддерживает $requestMethod";
    }
} else {
        require_once "./../View/404.html";
    }

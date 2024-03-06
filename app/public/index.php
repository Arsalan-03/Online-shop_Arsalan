<?php
use Controller\UserController;
use Controller\MainController;

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once './../Autoloader.php';
//эта строка кода подключает и регистрирует автозагрузчик классов, в определенном файле "Autoloader.php".
$dir = dirname(__DIR__);
print_r($dir);
die();
Autoloader::registrate($dir);


//require_once './../Controller/UserController.php';
//require_once './../Controller/MainController.php';

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

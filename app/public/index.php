<?php

use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;
use Core\App;
use Core\Autoloader;
use Request\LoginRequest;
use Request\OrderRequest;
use Request\ProductRequest;
use Request\RegistrateRequest;

require_once './../Core/App.php';
require_once './../Core/Autoloader.php';

//эта строка кода подключает и регистрирует автозагрузчик классов, в определенном файле "Autoloader.php".
$dir = dirname(__DIR__);

Autoloader::registrate($dir);

$app = new App();

$app->get('/registrate', UserController::class, 'getRegistrate');
$app->get('/login', UserController::class, 'getLogin');
$app->get('/main', MainController::class, 'getProducts');
$app->get('/cart', CartController::class, 'getCart');
$app->get('/order', OrderController::class, 'getOrders');

$app->post('/registrate', UserController::class, 'registrate', RegistrateRequest::class);
$app->post('/logout', UserController::class, 'logout', RegistrateRequest::class);
$app->post('/login', UserController::class, 'login', LoginRequest::class);
$app->post('/add-product', ProductController::class, 'addProduct', ProductRequest::class);
$app->post('/delete-product', ProductController::class, 'deleteProducts', ProductRequest::class);
$app->post('/order', OrderController::class, 'order', OrderRequest::class);

$app->run();
//require_once './../Controller/UserController.php';
//require_once './../Controller/MainController.php';


<?php

use Core\App;
use Core\Autoloader;

require_once './../Core/App.php';
require_once './../Core/Autoloader.php';

//эта строка кода подключает и регистрирует автозагрузчик классов, в определенном файле "Autoloader.php".
$dir = dirname(__DIR__);

Autoloader::registrate($dir);

$app = new App();
$app->run();



//require_once './../Controller/UserController.php';
//require_once './../Controller/MainController.php';


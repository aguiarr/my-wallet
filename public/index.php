<?php

use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\CreateTables;

require __DIR__ . '/../vendor/autoload.php';

$path = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/routes.php';

if(!array_key_exists($path, $rotas)){
    http_response_code(404);
    echo "ERROR 404";
    exit();
}
$classControl = $rotas[$path];

/** @var InterfaceController $controller */
$controller =  new $classControl;
$controller->request();
<?php

require __DIR__ . '/vendor/autoload.php';
use Wallet\Model\Infrastructure\Persistence\CreateTables;

$createTables = new CreateTables();
if($createTables->verificaDB() == false){
    $createTables->crateTables();
}

$comp = new \Wallet\Controller\Competencias\GerarCompetencias();
$comp->nextCompetencia();


require __DIR__ . '/public/index.php';
?>
<?php

namespace Wallet\Controller\Despesas;

use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\despesa_repository;

class ListarDespesas extends ControllerHtml implements InterfaceController
{


    private $repositorioDespeas;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioDespeas = new despesa_repository($connection);
    }

    public function request(): void
    {
        $despesas = $this->repositorioDespeas->findAll();
        echo $this->renderiza('despesas/listar-despesas.php',[
            'titulo'=> 'Lista de Despesas',
            'despesas' => $despesas
        ]);
    }
}
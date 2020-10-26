<?php


namespace Wallet\Controller\MetodosPagamentos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class ListarFormasPagamento extends ControllerHtml implements InterfaceController
{

    private $repositorioFormasPagamentos;
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioFormasPagamentos = new metodo_pagamentos_repository($this->connection);
    }

    public function request(): void
    {
        $colletionPagamento = $this->repositorioFormasPagamentos->findAll();

        echo $this->renderiza('configuration/formas-pagamento.php',[
            'titulo'=> 'Formas de Pagamento',
            'colletionPagamento' => $colletionPagamento
        ]);
    }

}
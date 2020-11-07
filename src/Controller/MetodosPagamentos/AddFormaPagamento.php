<?php


namespace Wallet\Controller\MetodosPagamentos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class AddFormaPagamento extends ControllerHtml implements InterfaceController
{
    private metodo_pagamentos_repository $repositorioFormasPagamento;
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioFormasPagamento = new metodo_pagamentos_repository($this->connection);
    }

    public function request(): void
    {
        echo $this->renderiza('configuration/formas-pagamento.php',[
            'titulo' => 'Formas de Pagamento'
        ]);
    }
}
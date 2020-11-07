<?php


namespace Wallet\Controller\MetodosPagamentos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class EditFormaPagamento extends ControllerHtml implements InterfaceController
{
    private metodo_pagamentos_repository $repositorioFormaPagamento;
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioFormaPagamento = new metodo_pagamentos_repository($this->connection);
    }

    public function request(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        if(is_null($id) || $id === false){
            header('Location: /listar-pagamentos');
            return;
        }
        $onePagamento = $this->repositorioFormaPagamento->find($id);
        $colletionPagamento = $this->repositorioFormaPagamento->findAll();

        echo $this->renderiza('configuration/formas-pagamento.php',[
           'titulo' =>'Formas de Pagamento',
           'colletionPagamento' => $colletionPagamento,
           'onePagamento' => $onePagamento[0]
       ]);
    }
}
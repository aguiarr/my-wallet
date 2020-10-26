<?php


namespace Wallet\Controller\MetodosPagamentos;


use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class PersistenceFormaPagamento implements InterfaceController
{

    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }

    public function request(): void
    {
        $formasPagamentos = new MetodosPagamentos();

        $nome = filter_input(
            INPUT_POST,
            'nome',
            FILTER_SANITIZE_STRING
        );
        if (is_null($nome) || $nome === falase){
            echo "Nome Inválido";
            echo $nome;
        }else{
            $formasPagamentos->setNome($nome);
        }

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        $repositorioMetodosPagamentos = new metodo_pagamentos_repository($this->connection);

        if(!is_null($id) || $id !== false) {
            $formasPagamentos->setId($id);
        }
        $repositorioMetodosPagamentos->save($formasPagamentos);

        header('Location: /listar-pagamentos', true, 302);
    }
}
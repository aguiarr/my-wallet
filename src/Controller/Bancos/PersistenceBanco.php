<?php


namespace Wallet\Controller\Bancos;


use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;

class PersistenceBanco implements InterfaceController
{

    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }
    public function request(): void
    {
        $banco = new Banco();

        $nome = filter_input(
            INPUT_POST,
            'nome',
            FILTER_SANITIZE_STRING
        );
        if(is_null($nome) || $nome === false){
            echo "Nome Inválido";
            echo $nome;
        }else{
            $banco->setNome($nome);
        }

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        $repositorioBanco = new banco_repository($this->connection);

        if(is_null($id) || $id === false){
            $repositorioBanco->save($banco);
        }else{
            $banco->setId($id);
            $repositorioBanco->save($banco);
        }

        header('Location: /listar-bancos', true, 302);
    }
}
<?php


namespace Wallet\Controller\Bancos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;

class RemoveBanco extends  ControllerHtml implements InterfaceController
{


    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }

    public function request(): void
    {
        $id = filter_input(
          INPUT_GET,
          'id',
          FILTER_VALIDATE_INT
        );
        if(is_null($id) || $id === false){
            header('Location: /listar-bancos');
            return;
        }
        $repositorioBanco = new banco_repository($this->connection);
        $banco = $repositorioBanco->find($id);
        $repositorioBanco->remove($banco[0]);

        header('Location: /listar-bancos');
    }
}
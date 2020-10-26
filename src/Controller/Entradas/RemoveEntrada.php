<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\entrada_repository;

class RemoveEntrada extends ControllerHtml implements InterfaceController
{

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
        if(is_null($id) || $id ===false){
            header('Location: /listar-entradas');
            return;
        }
        $repositorioEntrada = new entrada_repository($this->connection);
        $entrada = $repositorioEntrada->find($id);

        $repositorioEntrada->remove($entrada);

        header('Location: /listar-entradas');
    }
}
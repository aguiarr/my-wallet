<?php


namespace Wallet\Controller\Despesas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\despesa_repository;

class RemoveDespesa extends  ControllerHtml implements  InterfaceController
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
        if(is_null($id) || $id === false) {
            header('Location: /listar-despesas');
            return;
        }
        $despesaRepository = new despesa_repository($this->connection);
        $despesa = $despesaRepository->find($id);
        $despesaRepository->remove($despesa);

        header('Location: /listar-despesas');
    }
}
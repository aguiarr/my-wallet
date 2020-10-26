<?php


namespace Wallet\Controller\MetodosPagamentos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class RemoveFormaPagamento extends ControllerHtml implements InterfaceController
{


    private \PDO $connection;
    /**
     * @var metodo_pagamentos_repository
     */
    private metodo_pagamentos_repository $repositorioMetodosPagamento;

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
        if (is_null($id) || $id === false){
            header('Location: /listar-pagamentos');
            return;
        }
        $repositorioFormasPagamentos = new metodo_pagamentos_repository($this->connection);
        $formasPagamentos = $repositorioFormasPagamentos->find($id);
        $repositorioFormasPagamentos->remove($formasPagamentos);

        header('Location: /listar-pagamentos');
    }
}
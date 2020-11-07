<?php

namespace Wallet\Controller\Despesas;

use PDO;
use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class AddDespesa extends ControllerHtml implements InterfaceController
{


    private metodo_pagamentos_repository $repositorioFormasPagamento;
    private banco_repository $repositorioBancos;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioFormasPagamento = new metodo_pagamentos_repository($connection);
        $this->repositorioBancos = new banco_repository($connection);
    }

    public function request(): void
    {
        $bancos = $this->repositorioBancos->findAll();
        $formasPagamento = $this->repositorioFormasPagamento->findAll();
        echo $this->renderiza('despesas/form-despesa.php',[
            'titulo'=> 'Adicionar Despesa',
            'formasPagamento' => $formasPagamento,
            'bancos' => $bancos
        ]);
    }
}
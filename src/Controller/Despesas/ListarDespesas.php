<?php

namespace Wallet\Controller\Despesas;

use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\competencia_repository;
use Wallet\Model\Infrastructure\Repository\despesa_repository;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class ListarDespesas extends ControllerHtml implements InterfaceController
{


    private despesa_repository $repositorioDespeas;
    private metodo_pagamentos_repository $repositorioFormasPagamento;
    private competencia_repository $repositorioCompetencias;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioDespeas = new despesa_repository($connection);
        $this->repositorioFormasPagamento = new metodo_pagamentos_repository($connection);
        $this->repositorioCompetencias = new competencia_repository($connection);
    }

    public function request(): void
    {
        $despesas = $this->repositorioDespeas->findAll();
        $competencias = $this->repositorioCompetencias->findAll();
        $formasPagamentos = $this->repositorioFormasPagamento;
        echo $this->renderiza('despesas/listar-despesas.php',[
            'titulo'=> 'Lista de Despesas',
            'despesas' => $despesas,
            'competencias' => $competencias,
            'formaPagamento' => $formasPagamentos
        ]);
    }
}
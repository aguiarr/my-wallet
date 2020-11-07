<?php

namespace Wallet\Controller\Entradas;

use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\competencia_repository;
use Wallet\Model\Infrastructure\Repository\entrada_repository;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class ListarEntradas extends ControllerHtml implements InterfaceController
{

    private entrada_repository $repositorioEntrada;
    private competencia_repository $repositorioCompetencias;
    private metodo_pagamentos_repository $repositorioFormasPagamento;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioEntrada = new entrada_repository($connection);
        $this->repositorioCompetencias =  new competencia_repository($connection);
        $this->repositorioFormasPagamento = new metodo_pagamentos_repository($connection);
    }

    public function request(): void
    {
        $entradas = $this->repositorioEntrada->findAll();
        $competencias = $this->repositorioCompetencias->findAll();
        $formasPagamentos = $this->repositorioFormasPagamento;
        echo $this->renderiza('entradas/listar-entradas.php',[
            'titulo'=> 'Lista de Entradas',
            'entradas' => $entradas,
            'competencias' => $competencias,
            'formasPagamento' => $formasPagamentos
        ]);

    }
}
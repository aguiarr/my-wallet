<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class AddEntrada extends ControllerHtml implements InterfaceController
{
    private metodo_pagamentos_repository $repositorioFormaPagamentos;
    private banco_repository $repositorioBancos;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioFormaPagamentos = new metodo_pagamentos_repository($connection);
        $this->repositorioBancos = new banco_repository($connection);
    }

    public function request(): void
    {
        $bancos = $this->repositorioBancos->findAll();
        $formasPagamento = $this->repositorioFormaPagamentos->findAll();
        echo $this->renderiza('entradas/form-entrada.php',[
            'titulo' => 'Adicionar Entrada',
            'formasPagamento' => $formasPagamento,
            'bancos' => $bancos
        ]);
    }
}
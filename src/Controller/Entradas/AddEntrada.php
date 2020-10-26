<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class AddEntrada extends ControllerHtml implements InterfaceController
{
    private $repositorioFormaPagamentos;
    private $repositorioBancos;

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
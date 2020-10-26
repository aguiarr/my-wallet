<?php


namespace Wallet\Controller\Despesas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;
use Wallet\Model\Infrastructure\Repository\entrada_repository;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class EditDespesa extends ControllerHtml implements InterfaceController
{
    private $repositorioEntradas;
    private $repositorioFormasPagamento;
    private $repositorioBancos;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioEntradas = new entrada_repository($connection);
        $this->repositorioFormasPagamento = new metodo_pagamentos_repository($connection);
        $this->repositorioBancos = new banco_repository($connection);
    }
    public function request(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        if(is_null($id) || $id === false){
            header('Location: /listar-despesas');
            return;
        }

        $bancos = $this->repositorioBancos->findAll();
        $formasPagamento = $this->repositorioFormasPagamento->findAll();
        $despesa = $this->repositorioEntradas->find($id);
        echo $this->renderiza('despesas/form-despesa.php', [
            'despesa' => $despesa,
            'titulo' => 'Editar Despesa',
            'formasPagamento' => $formasPagamento,
            'bancos' => $bancos
        ]);
    }
}
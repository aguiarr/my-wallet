<?php


namespace Wallet\Controller\Despesas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;
use Wallet\Model\Infrastructure\Repository\despesa_repository;
use Wallet\Model\Infrastructure\Repository\entrada_repository;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class EditDespesa extends ControllerHtml implements InterfaceController
{
    private despesa_repository $repositorioDespesa;
    private metodo_pagamentos_repository $repositorioFormasPagamento;
    private banco_repository $repositorioBancos;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioDespesa = new despesa_repository($connection);
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

        $despesa = $this->repositorioDespesa->find($id);

        $bancos = $this->repositorioBancos->findAll();
        $bancoAtual = $this->repositorioBancos->find($despesa[0]->getBanco());

        $formasPagamento = $this->repositorioFormasPagamento->findAll();
        $formaPagamento = $this->repositorioFormasPagamento->find($despesa[0]->getMetodoPagamento());

        echo $this->renderiza('despesas/form-despesa.php', [
            'despesa' => $despesa[0],
            'titulo' => 'Editar Despesa',
            'formasPagamento' => $formasPagamento,
            'formaPagamento' => $formaPagamento[0],
            'bancos' => $bancos,
            'bancoAtual' => $bancoAtual[0]
        ]);
    }
}
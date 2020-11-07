<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;
use Wallet\Model\Infrastructure\Repository\entrada_repository;
use Wallet\Model\Infrastructure\Repository\metodo_pagamentos_repository;

class EditEntrada extends ControllerHtml implements InterfaceController
{

    private $repositorioEntradas;
    private $repositorioFormasPagamentos;
    private $repositorioBancos;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioEntradas = new entrada_repository($connection);
        $this->repositorioFormasPagamentos = new metodo_pagamentos_repository($connection);
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
            header('Location: /listar-entradas');
            return;
        }

        $entrada = $this->repositorioEntradas->find($id);

        $bancos = $this->repositorioBancos->findAll();
        $bancoAtual = $this->repositorioBancos->find($entrada[0]->getBanco());


        $formasPagamento = $this->repositorioFormasPagamentos->findAll();
        $formaPagamento = $this->repositorioFormasPagamentos->find($entrada[0]->getMetodoPagamento());

        echo $this->renderiza('entradas/form-entrada.php', [
            'entrada' => $entrada[0],
            'titulo' => 'Editar Entrada',
            'formasPagamento' => $formasPagamento,
            'formaPagamento' => $formaPagamento[0],
            'bancos' => $bancos,
            'bancoAtual' => $bancoAtual[0]
        ]);
    }
}
<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\EntityManagerCreator;
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

        $bancos = $this->repositorioBancos->findAll();
        $formasPagamento = $this->repositorioFormasPagamentos->findAll();
        $entrada = $this->repositorioEntradas->find($id);
        echo $this->renderiza('entradas/form-entrada.php', [
            'entrada' => $entrada,
            'titulo' => 'Editar Entrada',
            'formasPagamento' => $formasPagamento,
            'bancos' => $bancos
        ]);
    }
}
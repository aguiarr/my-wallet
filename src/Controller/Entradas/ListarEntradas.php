<?php

namespace Wallet\Controller\Entradas;

use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\entrada_repository;

class ListarEntradas extends ControllerHtml implements InterfaceController
{

    private $repositorioEntrada;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioEntrada = new entrada_repository($connection);
    }

    public function request(): void
    {
        $entradas = $this->repositorioEntrada->findAll();
        echo $this->renderiza('entradas/listar-entradas.php',[
            'titulo'=> 'Lista de Entradas',
            'entradas' => $entradas
        ]);

    }
}
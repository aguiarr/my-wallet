<?php

namespace Wallet\Controller\Entradas;

use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class ListarEntradas extends ControllerHtml implements InterfaceController
{

    private $repositorioEntrada;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioEntrada = $entityManager
            ->getRepository(Entrada::class);
    }

    public function request(): void
    {
        $entradas = $this->repositorioEntrada->findAll();
        echo $this->renderiza('entradas/listar-entradas.php',[
            'titulo'=> 'Lista de Entradas',
            'entradas' => $entradas
        ]);
        //var_dump($entradas);
    }
}
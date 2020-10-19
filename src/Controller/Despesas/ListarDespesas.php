<?php

namespace Wallet\Controller\Despesas;

use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class ListarDespesas extends ControllerHtml implements InterfaceController
{


    private $repositorioDespeas;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioDespeas = $entityManager
            ->getRepository(Despesa::class);
    }

    public function request(): void
    {
        $despesas = $this->repositorioDespeas->findAll();
        echo $this->renderiza('despesas/listar-despesas.php',[
            'titulo'=> 'Lista de Despesas',
            'despesas' => $despesas
        ]);
    }
}
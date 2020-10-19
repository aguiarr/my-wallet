<?php


namespace Wallet\Controller\Bancos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class AddBanco extends ControllerHtml implements InterfaceController
{

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioBanco = $entityManager
            ->getRepository(Banco::class);
    }

    public function request(): void
    {
        echo $this->renderiza('configuration/bancos.php',[
           'titulo'=>'Bancos'
        ]);
    }
}
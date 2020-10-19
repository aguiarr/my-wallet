<?php


namespace Wallet\Controller\Bancos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class ListarBanco extends ControllerHtml implements InterfaceController
{

    private $repositorioBancos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
        ->getEntityManager();
        $this->repositorioBancos = $entityManager
            ->getRepository(Banco::class);
    }

    public function request(): void
    {
        $bancos = $this->repositorioBancos->findAll();
        echo $this->renderiza('configuration/bancos.php', [
            'titulo' => 'Bancos',
            'bancos' => $bancos
        ]);
    }
}
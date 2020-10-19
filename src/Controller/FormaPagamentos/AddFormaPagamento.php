<?php


namespace Wallet\Controller\FormaPagamentos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\FormasPagamentos;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class AddFormaPagamento extends ControllerHtml implements InterfaceController
{
    private $repositorioFormasPagamento;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioFormasPagamento = $entityManager
            ->getRepository(FormasPagamentos::class);
    }

    public function request(): void
    {
        echo $this->renderiza('configuration/formas-pagamento.php',[
            'titulo' => 'Formas de Pagamento'
        ]);
    }
}
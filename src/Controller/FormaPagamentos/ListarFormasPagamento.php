<?php


namespace Wallet\Controller\FormaPagamentos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class ListarFormasPagamento extends ControllerHtml implements InterfaceController
{

    private $repositorioFormasPagamentos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioFormasPagamentos = $entityManager
            ->getRepository(MetodosPagamentos::class);
    }

    public function request(): void
    {
        $colletionPagamento = $this->repositorioFormasPagamentos->findAll();

        echo $this->renderiza('configuration/formas-pagamento.php',[
            'titulo'=> 'Formas de Pagamento',
            'colletionPagamento' => $colletionPagamento
        ]);
    }

}
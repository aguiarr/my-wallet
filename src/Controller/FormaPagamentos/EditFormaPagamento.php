<?php


namespace Wallet\Controller\FormaPagamentos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class EditFormaPagamento extends ControllerHtml implements InterfaceController
{
    private $repositorioFormaPagamento;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioFormaPagamento = $entityManager
            ->getRepository(MetodosPagamentos::class);
    }

    public function request(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        if(is_null($id) || $id === false){
            header('Location: /listar-pagamentos');
            return;
        }
        $onePagamento = $this->repositorioFormaPagamento->find($id);
        $colletionPagamento = $this->repositorioFormaPagamento->findAll();

        echo $this->renderiza('configuration/formas-pagamento.php',[
           'titulo' =>'Formas de Pagamento',
           'colletionPagamento' => $colletionPagamento,
           'onePagamento' => $onePagamento
       ]);
    }
}
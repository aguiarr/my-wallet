<?php


namespace Wallet\Controller\Despesas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\FormasPagamentos;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class EditDespesa extends ControllerHtml implements InterfaceController
{
    private $repositorioEntradas;
    private $repositorioFormasPagamento;
    private $repositorioBancos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioEntradas = $entityManager
            ->getRepository(Despesa::class);
        $this->repositorioFormasPagamento = $entityManager
            ->getRepository(FormasPagamentos::class);
        $this->repositorioBancos = $entityManager
            ->getRepository(Banco::class);
    }
    public function request(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        if(is_null($id) || $id === false){
            header('Location: /listar-despesas');
            return;
        }

        $bancos = $this->repositorioBancos->findAll();
        $formasPagamento = $this->repositorioFormasPagamento->findAll();
        $despesa = $this->repositorioEntradas->find($id);
        echo $this->renderiza('despesas/form-despesa.php', [
            'despesa' => $despesa,
            'titulo' => 'Editar Despesa',
            'formasPagamento' => $formasPagamento,
            'bancos' => $bancos
        ]);
    }
}
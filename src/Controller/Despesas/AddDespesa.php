<?php

namespace Wallet\Controller\Despesas;

use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\FormasPagamentos;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class AddDespesa extends ControllerHtml implements InterfaceController
{

    private $repositorioCurso;
    private $repositorioFormasPagamento;
    private $repositorioBancos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCurso = $entityManager
            ->getRepository(Despesa::class);
        $this->repositorioFormasPagamento = $entityManager
            ->getRepository(FormasPagamentos::class);
        $this->repositorioBancos = $entityManager
            ->getRepository(Banco::class);
    }

    public function request(): void
    {
        $bancos = $this->repositorioBancos->findAll();
        $formasPagamento = $this->repositorioFormasPagamento->findAll();
        echo $this->renderiza('despesas/form-despesa.php',[
            'titulo'=> 'Adicionar Despesa',
            'formasPagamento' => $formasPagamento,
            'bancos' => $bancos
        ]);
    }
}
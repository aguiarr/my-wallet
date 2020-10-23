<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class AddEntrada extends ControllerHtml implements InterfaceController
{
    private $repositorioCurso;
    private $repositorioFormaPagamentos;
    private $repositorioBancos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCurso = $entityManager
            ->getRepository(Entrada::class);
        $this->repositorioFormaPagamentos = $entityManager
            ->getRepository(MetodosPagamentos::class);
        $this->repositorioBancos = $entityManager
            ->getRepository(Banco::class);
    }

    public function request(): void
    {
        $bancos = $this->repositorioBancos->findAll();
        $formasPagamento = $this->repositorioFormaPagamentos->findAll();
        echo $this->renderiza('entradas/form-entrada.php',[
            'titulo' => 'Adicionar Entrada',
            'formasPagamento' => $formasPagamento,
            'bancos' => $bancos
        ]);
    }
}
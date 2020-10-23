<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class EditEntrada extends ControllerHtml implements InterfaceController
{

    private $repositorioEntradas;
    private $repositorioFormasPagamentos;
    private $repositorioBancos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioEntradas = $entityManager
            ->getRepository(Entrada::class);
        $this->repositorioFormasPagamentos = $entityManager
            ->getRepository(MetodosPagamentos::class);
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
            header('Location: /listar-entradas');
            return;
        }

        $bancos = $this->repositorioBancos->findAll();
        $formasPagamento = $this->repositorioFormasPagamentos->findAll();
        $entrada = $this->repositorioEntradas->find($id);
        echo $this->renderiza('entradas/form-entrada.php', [
            'entrada' => $entrada,
            'titulo' => 'Editar Entrada',
            'formasPagamento' => $formasPagamento,
            'bancos' => $bancos
        ]);
    }
}
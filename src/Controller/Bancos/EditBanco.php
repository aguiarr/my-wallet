<?php


namespace Wallet\Controller\Bancos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class EditBanco extends ControllerHtml implements InterfaceController
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
       $id = filter_input(
           INPUT_GET,
           'id',
           FILTER_VALIDATE_INT
       );
       if(is_null($id) || $id === false){
           header('Location: /listar-bancos');
           return;
       }

       $banco = $this->repositorioBancos->findAll();
       $bancoAtual = $this->repositorioBancos->find($id);
       echo $this->renderiza('configuration/bancos.php', [
           'titulo' => 'Bancos',
           'bancoAtual' => $bancoAtual,
           'bancos' => $banco
        ]);
    }
}
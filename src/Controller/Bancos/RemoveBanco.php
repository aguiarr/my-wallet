<?php


namespace Wallet\Controller\Bancos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class RemoveBanco extends  ControllerHtml implements InterfaceController
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
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
        $banco = $this->entityManager->getReference(Banco::class, $id);
        $this->entityManager->remove($banco);
        $this->entityManager->flush();
        header('Location: /listar-bancos');
    }
}
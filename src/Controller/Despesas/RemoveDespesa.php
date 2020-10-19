<?php


namespace Wallet\Controller\Despesas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class RemoveDespesa extends  ControllerHtml implements  InterfaceController
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
        if(is_null($id) || $id === false) {
            header('Location: /listar-despesas');
            return;
        }
        $despesa = $this->entityManager->getReference(Despesa::class, $id);
        $this->entityManager->remove($despesa);
        $this->entityManager->flush();
        header('Location: /listar-despesas');
    }
}
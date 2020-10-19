<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class RemoveEntrada extends ControllerHtml implements InterfaceController
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
        if(is_null($id) || $id ===false){
            header('Location: /listar-entradas');
            return;
        }
        $entrada = $this->entityManager->getReference(Entrada::class, $id);
        $this->entityManager->remove($entrada);
        $this->entityManager->flush();
        header('Location: /listar-entradas');
    }
}
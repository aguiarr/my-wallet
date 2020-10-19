<?php


namespace Wallet\Controller\FormaPagamentos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\FormasPagamentos;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class RemoveFormaPagamento extends ControllerHtml implements InterfaceController
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
        if (is_null($id) || $id === false){
            header('Location: /listar-pagamentos');
            return;
        }
        $formasPagamentos = $this->entityManager->getReference(FormasPagamentos::class, $id);
        $this->entityManager->remove($formasPagamentos);
        $this->entityManager->flush();
        header('Location: /listar-pagamentos');
    }
}
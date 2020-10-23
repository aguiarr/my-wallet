<?php


namespace Wallet\Controller\FormaPagamentos;


use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class PersistenceFormaPagamento implements InterfaceController
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function request(): void
    {
        $formasPagamentos = new MetodosPagamentos();

        $nome = filter_input(
            INPUT_POST,
            'nome',
            FILTER_SANITIZE_STRING
        );
        if (is_null($nome) || $nome === falase){
            echo "Nome Inválido";
            echo $nome;
        }else{
            $formasPagamentos->setNome($nome);
        }

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        if(is_null($id) || $id === false){
            $this->entityManager->persist($formasPagamentos);
        }else{
            $formasPagamentos->setId($id);
            $this->entityManager->merge($formasPagamentos);
        }
        $this->entityManager->flush();

        header('Location: /listar-pagamentos', true, 302);
    }
}
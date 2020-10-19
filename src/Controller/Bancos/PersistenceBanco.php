<?php


namespace Wallet\Controller\Bancos;


use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class PersistenceBanco implements InterfaceController
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }
    public function request(): void
    {
        $banco = new Banco();

        $nome = filter_input(
            INPUT_POST,
            'nome',
            FILTER_SANITIZE_STRING
        );
        if(is_null($nome) || $nome === false){
            echo "Nome Inválido";
            echo $nome;
        }else{
            $banco->setNome($nome);
        }

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        if(is_null($id) || $id === false){
            $this->entityManager->persist($banco);
        }else{
            $banco->setId($id);
            $this->entityManager->merge($banco);
        }
        $this->entityManager->flush();

        header('Location: /listar-bancos', true, 302);
    }
}
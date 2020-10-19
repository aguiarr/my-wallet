<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class PersistenceEntrada implements InterfaceController
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function request(): void
    {
        $entrada = new Entrada();

        $descricao = filter_input(
          INPUT_POST,
          'descricao',
          FILTER_SANITIZE_STRING
        );

        if(is_null($descricao) || $descricao === false){
            echo "Descricao Inválida";
        }else{
            $entrada->setDescricao($descricao);
        }

        $valor = filter_input(
            INPUT_POST,
            'valor',
            FILTER_VALIDATE_FLOAT
        );

        if(is_null($valor) || $valor === false ){
            echo "Valor Inválido";
        }else{
            $entrada->setValor($valor);
        }

        $data = filter_input(
            INPUT_POST,
            'data',
            FILTER_SANITIZE_STRING
        );

        if(is_null($data) || $data === false){
            echo "Data Inválida";
        }else{
            $entrada->setDate($data);
        }

        $formaPagamento = filter_input(
            INPUT_POST,
            'formaPagamento',
            FILTER_SANITIZE_STRING
        );
        if(is_null($formaPagamento) || $formaPagamento === false){
            echo  "Forma de Pagamento inválida.";
        }else{
            $entrada->setPagamento($formaPagamento);
        }

        if(is_null($id) || $id === false){
            $this->entityManager->persist($entrada);
        }else{
            $entrada->setId($id);
            $this->entityManager->merge($entrada);
        }
        $this->entityManager->flush();


        header('Location: /listar-entradas', true, 302);
    }
}
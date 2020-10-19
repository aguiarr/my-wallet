<?php


namespace Wallet\Controller\Despesas;


use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class PersistenceDespesa implements  InterfaceController
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }
    public function request(): void
    {
        $despesa = new Despesa();

        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

        if(is_null($descricao) || $descricao === false){
            echo "Descricao Inválida";
            echo $descricao;
        }else{
            $despesa->setDescricao($descricao);
        }

        $valor = filter_input(
            INPUT_POST,
            'valor',
            FILTER_VALIDATE_FLOAT
        );

        if(is_null($valor) || $valor === false ){
            echo "Valor Inválido";
        }else{
            $despesa->setValor(floatval($valor));
        }

        $data = filter_input(
            INPUT_POST,
            'data',
            FILTER_SANITIZE_STRING
        );

        if(is_null($data) || $data === false){
            echo "Data Inválida";
        }else{
            $despesa->setDate($data);
        }

        $formaPagamento = filter_input(
            INPUT_POST,
            'formaPagamento',
            FILTER_SANITIZE_STRING
        );
        if(is_null($formaPagamento) || $formaPagamento === false){
            echo  "Forma de Pagamento inválida.";
        }else{
            $despesa->setPagamento($formaPagamento);
        }

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        if(is_null($id) || $id === false){
            $this->entityManager->persist($despesa);
        }else{
            $despesa->setId($id);
            $this->entityManager->merge($despesa);
        }
        $this->entityManager->flush();


        header('Location: /listar-despesas', true, 302);
    }
}
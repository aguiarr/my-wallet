<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\entrada_repository;

class PersistenceEntrada implements InterfaceController
{

    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
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

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        $repositorioEntrada = new entrada_repository($this->connection);

        if(!is_null($id) || $id !== false){
            $entrada->setId($id);
        }

        $repositorioEntrada->save($entrada);


        header('Location: /listar-entradas', true, 302);
    }
}
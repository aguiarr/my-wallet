<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\Competencias\GerarCompetencias;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\competencia_repository;
use Wallet\Model\Infrastructure\Repository\entrada_repository;

class PersistenceEntrada implements InterfaceController
{

    private entrada_repository $repositorioEntrada;
    private competencia_repository $repositorioCompetencia;
    private GerarCompetencias $gerarCompetencia;
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioEntrada = new entrada_repository($this->connection);
        $this->repositorioCompetencia = new competencia_repository($this->connection);
        $this->gerarCompetencia = new GerarCompetencias();
    }

    public function request(): void
    {
        $descricao = filter_input(
          INPUT_POST,
          'descricao',
          FILTER_SANITIZE_STRING
        );

        if(is_null($descricao) || $descricao === false){
            echo "Descricao Inválida";
        }

        $valor = filter_input(
            INPUT_POST,
            'valor',
            FILTER_VALIDATE_FLOAT
        );

        if(is_null($valor) || $valor === false ){
            echo "Valor Inválido";
        }
        $data = filter_input(
            INPUT_POST,
            'data',
            FILTER_SANITIZE_STRING
        );

        if(is_null($data) || $data === false){
            echo "Data Inválida";
        }

        $formaPagamento = filter_input(
            INPUT_POST,
            'formaPagamento',
            FILTER_VALIDATE_INT
        );
        if(is_null($formaPagamento) || $formaPagamento === false){
            echo  "Forma de Pagamento inválida.";
        }

        $banco = filter_input(
            INPUT_POST,
            'banco',
            FILTER_VALIDATE_INT
        );

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        $competencia = substr($data,0,7);
        $this->gerarCompetencia->gerarCompetencia($competencia);


        $objCompetencia = $this->repositorioCompetencia->findByElement($competencia);
        $idCompetencia = $objCompetencia[0]->getId();

        $entrada = new Entrada($id, $descricao, $valor, $data, $idCompetencia, $banco, $formaPagamento);
//        var_dump($entrada);
        $this->repositorioEntrada->save($entrada);

        $valorEntrada = $this->repositorioCompetencia->attValor($idCompetencia);

        $objCompetencia[0]->setValor($valorEntrada);
        $this->repositorioCompetencia->save($objCompetencia[0]);


        header('Location: /listar-entradas', true, 302);
    }
}
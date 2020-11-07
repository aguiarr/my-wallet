<?php


namespace Wallet\Controller\Despesas;


use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\competencia_repository;
use Wallet\Model\Infrastructure\Repository\despesa_repository;

class PersistenceDespesa implements  InterfaceController
{

    private competencia_repository $repositorioCompetencia;
    private despesa_repository $repositorioDespesa;
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioDespesa = new despesa_repository($this->connection);
        $this->repositorioCompetencia = new competencia_repository($this->connection);
    }

    public function request(): void
    {

        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

        if (is_null($descricao) || $descricao === false) {
            echo "Descricao Inválida";
            echo $descricao;
        }

        $valor = filter_input(
            INPUT_POST,
            'valor',
            FILTER_VALIDATE_FLOAT
        );

        if (is_null($valor) || $valor === false) {
            echo "Valor Inválido";
        }
        $data = filter_input(
            INPUT_POST,
            'data',
            FILTER_SANITIZE_STRING
        );

        if (is_null($data) || $data === false) {
            echo "Data Inválida";
        }

        $formaPagamento = filter_input(
            INPUT_POST,
            'formaPagamento',
            FILTER_VALIDATE_INT
        );
        if (is_null($formaPagamento) || $formaPagamento === false) {
            echo "Forma de Pagamento inválida.";
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
        $objCompetencia = $this->repositorioCompetencia->findByElement($competencia);
        $idCompetencia = $objCompetencia[0]->getId();

        $despesa =  new Despesa($id, $descricao, $valor, $data, $idCompetencia, $banco, $formaPagamento);
//        var_dump($despesa);

        $this->repositorioDespesa->save($despesa);

        $valorDespesas = $this->repositorioCompetencia->attValor($idCompetencia);

        $objCompetencia[0]->setValor($valorDespesas);
        $this->repositorioCompetencia->save($objCompetencia[0]);



        header('Location: /listar-despesas', true, 302);
    }
}
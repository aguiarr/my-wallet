<?php


namespace Wallet\Controller\Despesas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\competencia_repository;
use Wallet\Model\Infrastructure\Repository\despesa_repository;

class RemoveDespesa extends  ControllerHtml implements  InterfaceController
{

    private \PDO $connection;
    private competencia_repository $repositorioCompetencia;
    private despesa_repository $despesaRepository;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->despesaRepository = new despesa_repository($this->connection);
        $this->repositorioCompetencia = new competencia_repository($this->connection);
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

        $despesa = $this->despesaRepository->find($id);
        $this->despesaRepository->remove($despesa[0]);

        $valorDespesa= $this->repositorioCompetencia->attValor($despesa[0]->getCompetencia());
        $objCompetencia = $this->repositorioCompetencia->find($despesa[0]->getCompetencia());

        $objCompetencia[0]->setValor($valorDespesa);
        $this->repositorioCompetencia->save($objCompetencia[0]);

        header('Location: /listar-despesas');
    }
}
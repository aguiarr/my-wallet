<?php


namespace Wallet\Controller\Entradas;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\competencia_repository;
use Wallet\Model\Infrastructure\Repository\entrada_repository;

class RemoveEntrada extends ControllerHtml implements InterfaceController
{

    private \PDO $connection;
    private competencia_repository $repositorioCompetencia;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioCompetencia = new competencia_repository($this->connection);
    }

    public function request(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        if(is_null($id) || $id === false){
            header('Location: /listar-entradas');
            return;
        }
        $repositorioEntrada = new entrada_repository($this->connection);
        $entrada = $repositorioEntrada->find($id);
        $repositorioEntrada->remove($entrada[0]);

        $valorEntrada = $this->repositorioCompetencia->attValor($entrada[0]->getCompetencia());
        $objCompetencia = $this->repositorioCompetencia->find($entrada[0]->getCompetencia());
        $objCompetencia[0]->setValor($valorEntrada);
        $this->repositorioCompetencia->save($objCompetencia[0]);

        header('Location: /listar-entradas');
    }
}
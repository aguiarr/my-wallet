<?php


namespace Wallet\Model\Infrastructure\Repository;


use PDO;
use Wallet\Model\Configuration\Competencia;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Repository\CompetenciaRepository;

class competencia_repository implements CompetenciaRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $sqlQuery = 'SELECT * FROM competencia;';
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydratedList($stmt);
    }

    public function find($id): array
    {
       $sqlQuery = 'SELECT * FROM competencia WHERE id = ?;';
       $stmt = $this->connection->prepare($sqlQuery);
       $stmt->bindValue(1, $id);
       $stmt->execute();

       return $this->hydratedList($stmt);
    }

    public function findByElement($element): array
    {
        $sqlQuery = 'SELECT * FROM competencia WHERE competencia = ?;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $element);
        $stmt->execute();

        return $this->hydratedList($stmt);
    }


    private function insert(Competencia $competencia): bool
    {
        $sqlQuery = 'INSERT INTO competencia (competencia, initial_date, final_date, valor) VALUES (:competencia, :initial_date, :final_date, :valor);';
        $stmt = $this->connection->prepare($sqlQuery);

        $success = $stmt->execute([
           ':competencia'=> $competencia->getCompetencia(),
           ':initial_date' => $competencia->getInitialDate(),
           ':final_date' => $competencia->getFinalDate(),
           ':valor' => $competencia->getValor()
        ]);
        if($success){
            $competencia->setId($this->connection->lastInsertId());
        }

        return $success;
    }

    private function update(Competencia $competencia): bool
    {
        $sqlQuery = 'UPDATE competencia SET competencia = :competencia, initial_date = :inital_date, final_date = :final_date, valor = :valor WHERE :id = :id;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(':competencia', $competencia->getCompetencia());
        $stmt->bindValue(':inital_date', $competencia->getInitialDate());
        $stmt->bindValue(':final_date', $competencia->getFinalDate());
        $stmt->bindValue(':valor', $competencia->getValor());
        $stmt->bindValue(':id', $competencia->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function save(Competencia $competencia): bool
    {
        if ($competencia->getId() === null){
            return $this->insert($competencia);
        }

        return $this->update($competencia);
    }

    public function remove(Competencia $competencia): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM competencia WHERE id = ?;');
        $stmt->bindValue(1, $competencia->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function hydratedList(\PDOStatement $stmt): array
    {
        $dataList = $stmt->fetchAll();
        $list = [];

        foreach ($dataList as $data) {
            $list[] = new Competencia(
                $data['id'],
                $data['competencia'],
                $data['initial_date'],
                $data['final_date'],
                $data['valor']
            );
        }
        return $list;
    }

    public function totalDespesa($id): float
    {
        $repositorioDespesa = new despesa_repository($this->connection);

        $despesas = $repositorioDespesa->findByCompetencia($id);
        foreach ($despesas as $despesa){
            $valor += floatval($despesa->getValor());
        }
        if($valor == null) $valor = 0;

        return $valor;
    }

    public function totalEntradas($id): float
    {
        $repositorioEntradas = new entrada_repository($this->connection);

        $entradas = $repositorioEntradas->findByCompetencia($id);
        foreach ($entradas as $entrada){
            $valor += floatval($entrada->getValor());
        }
        if($valor == null) $valor = 0;

        return $valor;
    }

    public function attValor($id): float
    {
        $valorDespesas = floatval($this->totalDespesa($id));
        $valorEntradas = floatval($this->totalEntradas($id));

        if($valorDespesas === null || $valorEntradas === null ||$valorDespesas == $valorEntradas) $total = 0;
        if($valorDespesas < $valorEntradas) $total = $valorEntradas - $valorDespesas;
        if($valorEntradas < $valorDespesas) $total = $valorDespesas - $valorEntradas;

        return $total;
    }
}
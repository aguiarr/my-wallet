<?php


namespace Wallet\Model\Infrastructure\Repository;


use PDO;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Repository\DespesaRepository;

class despesa_repository implements DespesaRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $sqlQuery = 'SELECT * FROM despesas;';
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydratedList($stmt);
    }

    public function find($id): array
    {
        $sqlQuery = 'SELECT * FROM despesas WHERE id = ?;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $this->hydratedList($stmt);
    }
    public function findByCompetencia($id): array
    {
        $sqlQuery = 'SELECT * FROM despesas WHERE id_competencia = ?;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $this->hydratedList($stmt);
    }
    public function sumDespesas():float
    {
        $sqlQuery = 'SELECT SUM(valor) FROM despesas;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->execute();

        $dataList = $stmt->fetchAll();
        if($dataList[0]["SUM(valor)"] == null) return 0;
        
        return $dataList[0]["SUM(valor)"];
    }
    private function insert(Despesa $despesa): bool
    {
        $insertQuery = 'INSERT INTO despesas (valor, descricao, date, id_banco, id_competencia, id_metodo_pagamento) VALUES (:valor, :descricao, :date, :id_banco, :id_competencia, :id_metodo_pagamento);';
        $stmt = $this->connection->prepare($insertQuery);

        $success = $stmt->execute([
            ':valor' => $despesa->getValor(),
            ':descricao' => $despesa->getDescricao(),
            ':date' => $despesa->getDate(),
            ':id_banco' => $despesa->getBanco(),
            ':id_competencia' => $despesa->getCompetencia(),
            ':id_metodo_pagamento' => $despesa->getMetodoPagamento()
        ]);
        if ($success){
            $despesa->setId($this->connection->lastInsertId());
        }
        return $success;
    }

    private function update(Despesa $despesa): bool
    {
        $sqlQuery = 'UPDATE despesas SET valor = :valor, descricao = :descricao, date = :date, id_banco = :id_banco, id_competencia = :id_competencia, id_metodo_pagamento = :id_metodo_pagamento WHERE id = :id;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(':valor', $despesa->getValor());
        $stmt->bindValue(':descricao', $despesa->getDescricao());
        $stmt->bindValue(':date', $despesa->getDate());
        $stmt->bindValue(':id_banco', $despesa->getBanco());
        $stmt->bindValue(':id_competencia', $despesa->getCompetencia());
        $stmt->bindValue(':id_metodo_pagamento', $despesa->getMetodoPagamento());
        $stmt->bindValue(':id', $despesa->getId());

        return $stmt->execute();
    }

    public function save(Despesa $despesa): bool
    {
        if ($despesa->getId() === null){
            return $this->insert($despesa);
        }
        return $this->update($despesa);
    }

    public function remove(Despesa $despesa): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM despesas WHERE id = ?;');
        $stmt->bindValue(1, $despesa->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function hydratedList(\PDOStatement $stmt): array
    {
        $dataList = $stmt->fetchAll();
        $list = [];

        foreach ($dataList as $data){
            $list[] = new Despesa(
                $data['id'],
                $data['descricao'],
                $data['valor'],
                $data['date'],
                $data['id_competencia'],
                $data['id_banco'],
                $data['id_metodo_pagamento']
            );
        }
        return $list;
    }
}
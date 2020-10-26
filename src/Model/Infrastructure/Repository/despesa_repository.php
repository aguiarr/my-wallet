<?php


namespace Wallet\Model\Infrastructure\Repository;


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

        return $this->hydrateList($stmt);
    }

    private function insert(Despesa $despesa): bool
    {
        $insertQuery = 'INSERT INTO despesas (valor, descricao, id_banco, id_competencia, id_metodo_pagamento) VALUES (:valor, :descricao, :id_banco, :id_competencia, :id_metodo_pagamento);';
        $stmt = $this->connection->prepare($insertQuery);

        $success = $stmt->execute([
            ':valor' => $despesa->getValor(),
            'descricao' => $despesa->getDescricao(),
            'id_banco' => $despesa->getBanco(),
            'id_competencia' => $despesa->getCompetencia(),
            'id_metodo_pagamento' => $despesa->getMetodoPagamento()
        ]);
        if ($success){
            $despesa->setId($this->connection->lastInsetId());
        }
        return $success;
    }

    private function update(Despesa $despesa): bool
    {
        $sqlQuery = 'UPDATE despesas SET valor = :valor, descricao = :descricao, id_banco = :id_banco, id_competencia = :id_competencia, id_metodo_pagamento = :id_metodo_pagamento WHERE id = :id);';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(':valor', $despesa->getValor());
        $stmt->bindValue(':descricao', $despesa->getDescricao());
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


    public function hydrateList(\PDOStatement $stmt): array
    {
        $dataList = $stmt->fetchAll();
        $list = [];

        foreach ($dataList as $data){
            $list[] = new Despesa(
                $data['id'],
                $data['valor'],
                $data['descricao'],
                $data['id_banco'],
                $data['id_competencia'],
                $data['id_metodo_pagamento']
            );
        }
        return $list;
    }
}
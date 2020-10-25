<?php


namespace Wallet\Model\Infrastructure\Repository;


use Wallet\Model\Configuration\MetodosPagamentos;
use Wallet\Model\Repository\MetodosPagamentosRepository;

class metodo_pagamentos_repository implements MetodosPagamentosRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $sqlQuery = 'SELECT * FROM metodo_pagamento;';
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydratedList($stmt);
    }

    public function find($id): array
    {
        $sqlQuery = 'SELECT * FROM metodo_pagamento WHERE id = ?;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $this->hydrateList($stmt);
    }

    public function insert(MetodosPagamentos $metodosPagamentos): bool
    {
        $sqlQuery = 'INSERT INTO metodo_pagamento (nome) VALUES (:nome);';
        $stmt = $this->connection->prepare($sqlQuery);

        $success = $stmt->execute([
            ':nome' => $metodosPagamentos->getNome()
        ]);
        if ($success){
            $metodosPagamentos->setId($this->connection->lastInsetId());
        }
        return $success;
    }

    public function update(MetodosPagamentos $metodosPagamentos): bool
    {
        $sqlQuery = 'UPDATE metodo_pagamento SET nome = :nome WHERE id = :id);';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(':nome', $metodosPagamentos->getNome());
        $stmt->bindValue(':id', $metodosPagamentos->getId());

        return $stmt->execute();
    }

    public function save(MetodosPagamentos $metodosPagamentos): bool
    {
        if ($metodosPagamentos->getId() === null){
            return $this->insert($metodosPagamentos);
        }
        return $this->update($metodosPagamentos);
    }

    public function remove(MetodosPagamentos $metodosPagamentos): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM metodo_pagamento WHERE id = ?;');
        $stmt->bindValue(1, $metodosPagamentos->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function hydrateList(\PDOStatement $stmt): array
    {
        $dataList = $stmt->fetchAll();
        $list = [];

        foreach ($dataList as $data){
            $list[] = new MetodosPagamentos(
                $data['id'],
                $data['nome']
            );
        }
        return $list;
    }
}
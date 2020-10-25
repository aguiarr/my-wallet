<?php


namespace Wallet\Model\Infrastructure\Repository;


use Wallet\Model\Entity\Entrada;
use Wallet\Model\Repository\EntradaRepository;

class entrada_repository implements EntradaRepository
{

    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $sqlQuery = 'SELECT * FROM entradas;';
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydratedList($stmt);
    }

    public function find($id): array
    {
        $sqlQuery = 'SELECT * FROM entradas WHERE id = ?;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $this->hydrateList($stmt);
    }

    public function insert(Entrada $entrada): bool
    {
        $insertQuery = 'INSERT INTO entradas (valor, descricao, id_banco, id_competencia, id_metodo_pagamento) VALUES (:valor, :descricao, :id_banco, :id_competencia, :id_metodo_pagamento);';
        $stmt = $this->connection->prepare($insertQuery);

        $success = $stmt->execute([
            ':valor' => $entrada->getValor(),
            'descricao' => $entrada->getDescricao(),
            'id_banco' => $entrada->getBanco(),
            'id_competencia' => $entrada->getCompetencia(),
            'id_metodo_pagamento' => $entrada->getMetodoPagamento()
        ]);
        if ($success){
            $entrada->setId($this->connection->lastInsetId());
        }
        return $success;
    }

    public function update(Entrada $entrada): bool
    {
        $sqlQuery = 'UPDATE entradas SET valor = :valor, descricao = :descricao, id_banco = :id_banco, id_competencia = :id_competencia, id_metodo_pagamento = :id_metodo_pagamento WHERE id = :id);';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(':valor', $entrada->getValor());
        $stmt->bindValue(':descricao', $entrada->getDescricao());
        $stmt->bindValue(':id_banco', $entrada->getBanco());
        $stmt->bindValue(':id_competencia', $entrada->getCompetencia());
        $stmt->bindValue(':id_metodo_pagamento', $entrada->getMetodoPagamento());
        $stmt->bindValue(':id', $entrada->getId());

        return $stmt->execute();
    }

    public function save(Entrada $entrada): bool
    {
        if ($entrada->getId() === null){
            return $this->insert($entrada);
        }
        return $this->update($entrada);
    }

    public function remove(Entrada $entrada): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM entradas WHERE id = ?;');
        $stmt->bindValue(1, $entrada->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function hydrateList(\PDOStatement $stmt): array
    {
        $dataList = $stmt->fetchAll();
        $list = [];

        foreach ($dataList as $data){
            $list[] = new Entrada(
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
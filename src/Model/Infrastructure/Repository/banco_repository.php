<?php


namespace Wallet\Model\Infrastructure\Repository;


use PDO;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Repository\BancoRepository;

class banco_repository implements BancoRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $sqlQuery = 'SELECT * FROM banco;';
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydratedList($stmt);
    }

    public function find($id): array
    {
        $sqlQuery = 'SELECT * FROM banco WHERE id = ?;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $this->hydratedList($stmt);
    }

    public function insert(Banco $banco): bool
    {
        $sqlQuery = 'INSERT INTO banco (nome) VALUES (:nome);';
        $stmt = $this->connection->prepare($sqlQuery);

        $success = $stmt->execute([
            ':nome' => $banco->getNome()
        ]);
        if ($success){
            $banco->setId($this->connection->lastInsertId());
        }
        return $success;
    }

    public function update(Banco $banco): bool
    {
        $sqlQuery = 'UPDATE banco SET nome = :nome WHERE id = :id;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(':nome', $banco->getNome());
        $stmt->bindValue(':id', $banco->getId());

        return $stmt->execute();
    }

    public function save(Banco $banco): bool
    {
        var_dump($banco->getId());
        if ($banco->getId() == null){
            return $this->insert($banco);
        }
        return $this->update($banco);
    }

    public function remove(Banco $banco): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM banco WHERE id = ?;');
        $stmt->bindValue(1, $banco->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function hydratedList(\PDOStatement $stmt): array
    {
        $dataList = $stmt->fetchAll();
        $list = [];
        foreach ($dataList as $data){

            $list[] = new Banco(
              $data['nome'],
              $data['id']
            );
        }
        return $list;
    }
}
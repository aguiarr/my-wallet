<?php


namespace Wallet\Model\Repository;


use Wallet\Model\Entity\Despesa;

interface DespesaRepository
{
    public function findAll(): array;
    public function find($id): array;
    public function save(Despesa $despesa): bool;
    public function remove(Despesa $despesa): bool;
}
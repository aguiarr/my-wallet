<?php


namespace Wallet\Model\Repository;


interface BancoRepository
{
    public function findAll(): array;
    public function find($id): array;
    public function save(Banco $banco): bool;
    public function remove(Banco $banco): bool;
}

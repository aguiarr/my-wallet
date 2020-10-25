<?php


namespace Wallet\Model\Repository;


use Wallet\Model\Entity\Banco;

interface BancoRepository
{
    public function findAll(): array;
    public function find($id): array;
    public function save(Banco $banco): bool;
    public function remove(Banco $banco): bool;
}

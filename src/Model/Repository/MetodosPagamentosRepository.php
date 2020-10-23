<?php


namespace Wallet\Model\Repository;


use Wallet\Model\Configuration\MetodosPagamentos;

interface MetodosPagamentosRepository
{
    public function findAll(): array;
    public function find($id): array;
    public function save(MetodosPagamentos $metodosPagamentos): bool;
    public function remove(MetodosPagamentos $metodosPagamentos): bool;
}
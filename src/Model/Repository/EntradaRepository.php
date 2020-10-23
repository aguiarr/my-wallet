<?php


namespace Wallet\Model\Repository;


use Wallet\Model\Entity\Entrada;

interface EntradaRepository
{
    public function findAll(): array;
    public function find($id): array;
    public function save(Entrada $entrada): bool;
    public function remove(Entrada $entrada): bool;
}
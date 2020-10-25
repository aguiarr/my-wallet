<?php


namespace Wallet\Model\Repository;




use Wallet\Model\Configuration\Competencia;

interface CompetenciaRepository
{
    public function findAll(): array;
    public function find($id): array;
    public function save(Competencia $competencia): bool;
    public function remove(Competencia $competencia): bool;
}
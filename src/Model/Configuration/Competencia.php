<?php


namespace Wallet\Model\Configuration;


class Competencia
{

    private ?int $id;
    private string $competencia;
    private date $initial_date;
    private date $final_date;
    private float $valor;

    public function __construct(string $competencia, date $initial_date, date $final_date, float $valor)
    {
        $this->competencia = $competencia;
        $this->initial_date = $initial_date;
        $this->final_date = $final_date;
        $this->valor = $valor;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCompetencia(): string
    {
        return $this->competencia;
    }

    public function setCompetencia(string $competencia): void
    {
        $this->competencia = $competencia;
    }

    public function getInitialDate(): date
    {
        return $this->initial_date;
    }

    public function setInitialDate(date $initial_date): void
    {
        $this->initial_date = $initial_date;
    }

    public function getFinalDate(): date
    {
        return $this->final_date;
    }

    public function setFinalDate(date $final_date): void
    {
        $this->final_date = $final_date;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

}
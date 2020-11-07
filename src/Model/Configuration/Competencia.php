<?php


namespace Wallet\Model\Configuration;


class Competencia
{

    private ?int $id;
    private string $competencia;
    private string $initial_date;
    private string $final_date;
    private float $valor;

    public function __construct(?int $id, string $competencia, string $initial_date, string $final_date, float $valor)
    {
        if($id === null){
            $this->id = null;
        }else{
            $this->id = $id;
        }
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

    public function getInitialDate(): string
    {
        return $this->initial_date;
    }

    public function setInitialDate(string $initial_date): void
    {
        $this->initial_date = $initial_date;
    }

    public function getFinalDate(): string
    {
        return $this->final_date;
    }

    public function setFinalDate(string $final_date): void
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
<?php

namespace Wallet\Model\Entity;

 class Despesa
 {

     private ?int $id;
     private string $descricao;
     private float $valor;
     private \DateTimeInterface $date;
     private int $competencia;
     private int $banco;
     private int $metodo_pagamento;


     public function __construct(?int $id, string $descricao, float $valor, \DateTimeInterface $date, int $competencia)
     {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->date = $date;
        $this->competencia = $competencia;
     }

     public function getId(): ?int
     {
         return $this->id;
     }


     public function setId(?int $id): void
     {
         $this->id = $id;
     }


     public function getDescricao(): string
     {
         return $this->descricao;
     }


     public function setDescricao(string $descricao): void
     {
         $this->descricao = $descricao;
     }


     public function getValor(): float
     {
         return $this->valor;
     }


     public function setValor(float $valor): void
     {
         $this->valor = $valor;
     }


     public function getDate(): \DateTimeInterface
     {
         return $this->date;
     }


     public function setDate(\DateTimeInterface $date): void
     {
         $this->date = $date;
     }


     public function getCompetencia(): int
     {
         return $this->competencia;
     }


     public function setCompetencia(int $competencia): void
     {
         $this->competencia = $competencia;
     }
     public function getBanco(): int
     {
         return $this->banco;
     }

     public function setBanco(int $banco): void
     {
         $this->competencia = $banco;
     }

     public function getMetodoPagamento(): int
     {
         return $this->metodo_pagamento;
     }


     public function setMetodoPagamento(int $metodo_pagamento): void
     {
         $this->metodo_pagamento = $metodo_pagamento;
     }

 }
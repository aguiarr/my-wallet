<?php

namespace Wallet\Model\Entity;

/**
 * @Entity
 * @Table(name="despesa")
 */

 class Despesa
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $descricao;

    /**
     * @Column(type="decimal")
     */
    private $valor;

    /**
     * @Column(type="string")
     */
    private $date;

     /**
      * @Column(type="string")
      */
     private $pagamento;


    public function getId(): int
    {
        return $this->id;
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

    public function getDate(): string
    {
        return $this->date;
    }
     public function setDate(string $date){

         $this->date = $date;
     }

     public function getPagamento()
     {
         return $this->pagamento;
     }
     public function setPagamento($pagamento): void
     {
         $this->pagamento = $pagamento;
     }
 }
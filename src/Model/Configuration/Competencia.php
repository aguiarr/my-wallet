<?php


namespace Wallet\Model\Configuration;

/**
 * @Entity
 * @Table(name="competencias")
 */
class Competencia
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $competencia;

    /**
     * @Column(type="decimal")
     */

    private $despesas;

    /**
     * @Column(type="decimal")
     */
    private $entradas;


    public function getId()
    {
        return $this->id;
    }

    public function getCompetencia()
    {
        return $this->competencia;
    }

    public function setCompetencia($competencia): void
    {
        $this->competencia = $competencia;
    }
    public function getDespesas()
    {
        return $this->despesas;
    }

    public function setDespesas($despesas): void
    {
        $this->despesas = $despesas;
    }

    public function getEntradas()
    {
        return $this->entradas;
    }

    public function setEntradas($entradas): void
    {
        $this->entradas = $entradas;
    }

}
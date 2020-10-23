<?php


namespace Wallet\Model\Entity;


class Banco
{

    private ?int $id;
    private string $nome;

    public function __construct()
    {

    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

}
<?php


namespace Wallet\Model\Configuration;


class MetodosPagamentos
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
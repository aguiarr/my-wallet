<?php


namespace Wallet\Controller\Bancos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Banco;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;

class ListarBanco extends ControllerHtml implements InterfaceController
{

    private $repositorioBancos;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioBancos = new banco_repository($this->connection);
    }

    public function request(): void
    {
        $bancos = $this->repositorioBancos->findAll();
        echo $this->renderiza('configuration/bancos.php', [
            'titulo' => 'Bancos',
            'bancos' => $bancos
        ]);
    }
}
<?php


namespace Wallet\Controller\Bancos;


use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;

class AddBanco extends ControllerHtml implements InterfaceController
{

    private \PDO $connection;
    private banco_repository $repositorioBanco;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioBanco = new banco_repository($this->connection);
    }

    public function request(): void
    {
        echo $this->renderiza('configuration/bancos.php',[
           'titulo'=>'Bancos'
        ]);
    }
}
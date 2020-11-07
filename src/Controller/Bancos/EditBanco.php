<?php


namespace Wallet\Controller\Bancos;


use PDO;
use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\banco_repository;

class EditBanco extends ControllerHtml implements InterfaceController
{
    private banco_repository $repositorioBancos;
    private PDO $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioBancos = new banco_repository($this->connection);
    }

    public function request(): void
    {
       $id = filter_input(
           INPUT_GET,
           'id',
           FILTER_VALIDATE_INT
       );
       if(is_null($id) || $id === false){
           header('Location: /listar-bancos');
           return;
       }

       $bancos = $this->repositorioBancos->findAll();
       $bancoAtual = $this->repositorioBancos->find($id);

       echo $this->renderiza('configuration/bancos.php', [
           'titulo' => 'Bancos',
           'bancos' => $bancos,
           'bancoAtual' => $bancoAtual[0]
        ]);
    }
}
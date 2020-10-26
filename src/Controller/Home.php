<?php


namespace Wallet\Controller;


use Wallet\Model\Entity\Despesa;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\EntityManagerCreator;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\despesa_repository;
use Wallet\Model\Infrastructure\Repository\entrada_repository;

class Home extends ControllerHtml implements InterfaceController
{

    private PDO $connection;
    private $repositorioEntradas;
    private $repositorioDespesas;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioEntradas = new entrada_repository($this->connection);
        $this->repositorioDespesas = new despesa_repository($this->connection);
    }

    public function totalEntrada()
    {
         $entradas = $this->repositorioEntradas->findAll();
         $totalEntrada = 0;
         foreach ($entradas as $entrada):
               $totalEntrada +=  $entrada->getValor();
         endforeach;

         return $totalEntrada;
    }


    public function totalDespesa()
    {
         $despesas = $this->repositorioDespesas->findAll();
         $totalDespesa = 0;
         foreach ($despesas as $despesa){
              $totalDespesa += $despesa->getValor();
         }

        return $totalDespesa;
    }

    public function total()
    {
        // $despesa = $this->totalDespesa();
        // $entrada = $this->totalEntrada();

        // if($despesa > $entrada){
        //     return $despesa - $entrada;
        // }else{
        //     return $entrada - $despesa;
        // }
    }


    public function request(): void
    {
        // $despesas = $this->repositorioDespesas->findAll();
        // $entradas = $this->repositorioEntradas->findAll();
        echo $this->renderiza('home.php',[
            'titulo'=> 'Home'
            // 'entradas' =>$entradas,
            // 'despesas' => $despesas,
       ]);
    }
}
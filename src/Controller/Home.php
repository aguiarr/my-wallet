<?php


namespace Wallet\Controller;


use Wallet\Model\Entity\Despesa;
use Wallet\Model\Entity\Entrada;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class Home extends ControllerHtml implements InterfaceController
{

    private $repositorioEntradas;
    private $repositorioDespesas;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioEntradas = $entityManager
            ->getRepository(Entrada::class);
        $this->repositorioDespesas = $entityManager
            ->getRepository(Despesa::class);
    }

    public function totalEntrada()
    {
        $entradas = $this->repositorioEntradas->findAll();
        $totalEntrada = 0;
        foreach ($entradas as $entrada):
             return $totalEntrada =  floatval($entrada->getValor());
        endforeach;
    }


    public function totalDespesa()
    {
        $despesas = $this->repositorioDespesas->findAll();
        $totalDespesa = 0;
        foreach ($despesas as $despesa){
            return $totalDespesa += floatval($despesa->getValor());
        }
    }

    public function total()
    {
        $despesa = $this->totalDespesa();
        $entrada = $this->totalEntrada();

        if($despesa > $entrada){
            return $despesa - $entrada;
        }else{
            return $entrada - $despesa;
        }
    }


    public function request(): void
    {
        $despesas = $this->repositorioDespesas->findAll();
        $entradas = $this->repositorioEntradas->findAll();
        echo $this->renderiza('home.php',[
            'titulo'=> 'Home',
            'entradas' =>$entradas,
            'despesas' => $despesas,
       ]);
    }
}
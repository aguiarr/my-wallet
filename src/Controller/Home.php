<?php


namespace Wallet\Controller;


use DateTime;
use PDO;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\competencia_repository;
use Wallet\Model\Infrastructure\Repository\despesa_repository;
use Wallet\Model\Infrastructure\Repository\entrada_repository;

class Home extends ControllerHtml implements InterfaceController
{

    private PDO $connection;
    private entrada_repository $repositorioEntradas;
    private despesa_repository $repositorioDespesas;
    private competencia_repository $repositorioCompetencias;

    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
        $this->repositorioEntradas = new entrada_repository($this->connection);
        $this->repositorioDespesas = new despesa_repository($this->connection);
        $this->repositorioCompetencias = new competencia_repository(($this->connection));
    }


    public function total(): float
    {
         $despesa = $this->repositorioDespesas->sumDespesas();
         $entrada = $this->repositorioEntradas->sumEntradas();

        if($despesa === null || $entrada === null ||$despesa == $entrada) $total = 0;
        $total = $entrada - $despesa;

        return $total;
    }

    public function situacao(): array
    {
        $despesa = $this->repositorioDespesas->sumDespesas();
        $entrada = $this->repositorioEntradas->sumEntradas();

        if($despesa === null || $entrada === null ||$despesa == $entrada) $total = 0;
        if($despesa < $entrada){ $situacao = 'Positico'; $cor = 'green';};
        if($entrada <= $despesa){ $situacao = 'Negativo'; $cor = 'red';};

        return [$situacao, $cor];
    }

    public function request(): void
    {
        $date = new DateTime();
        $competencia = $date->format('Y-m');
        $competenciaAtual = $this->repositorioCompetencias->findByElement($competencia);

        if($this->repositorioCompetencias->findByElement($competencia)){
            $total = $this->total();
            $situacao = $this->situacao();
        }else{
            $total = 0;
            $situacao = ['indefinida', 'black'];
        }

        $competencias = $this->repositorioCompetencias->findAll();
        echo $this->renderiza('home.php',[
            'titulo'=> 'Home',
            'competencias' => $competencias,
            'competenciaAtual' => $competenciaAtual[0],
            'total' => $total,
            'situacao' => $situacao
       ]);
    }
}
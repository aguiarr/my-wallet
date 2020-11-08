<?php


namespace Wallet\Controller\Competencias;



use DateTime;
use Wallet\Controller\ControllerHtml;
use Wallet\Controller\InterfaceController;
use Wallet\Model\Configuration\Competencia;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\competencia_repository;

class GerarCompetencias
{

    private competencia_repository $repositorioCompetenia;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioCompetenia = new competencia_repository($connection);
    }

    public function nextCompetencia()
    {
        $date = new DateTime();
        $competencia = $date->format('Y-m');
        if (!$this->repositorioCompetenia->findByElement($competencia)) {
            $initial_date = $competencia . '-01';
            $final_date = date("Y-m-t", strtotime($initial_date));

            $Objcompetencia = new Competencia(null, $competencia, $initial_date, $final_date, 0.0);
            $this->repositorioCompetenia->save($Objcompetencia);
        }
    }

    public function gerarCompetencia($competencia)
    {
        if (!$this->repositorioCompetenia->findByElement($competencia)) {
            $initial_date = $competencia . '-01';
            $final_date = date("Y-m-t", strtotime($initial_date));

            $Objcompetencia = new Competencia(null, $competencia, $initial_date, $final_date, 0.0);
            $this->repositorioCompetenia->save($Objcompetencia);
         }

    }

//    public function request(): void
//    {
//        $this->nextCompetencia();
//        header('Location: /home', true, 302);
//
//    }
}
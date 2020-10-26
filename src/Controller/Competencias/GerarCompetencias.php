<?php


namespace Wallet\Controller\Competencias;



use Wallet\Model\Configuration\Competencia;
use Wallet\Model\Infrastructure\Persistence\ConnectionCreator;
use Wallet\Model\Infrastructure\Repository\competencia_repository;

class GerarCompetencias
{
    /**
     * @var competencia_repository
     */
    private competencia_repository $repositorioCompetenia;

    public function __construct()
    {
        $connection = ConnectionCreator::createConnection();
        $this->repositorioCompetenia = new competencia_repository($connection);
    }

    public function gerarCompetencias()
    {
        for ($year = 2020; $year < 2050; $year++)
        {
            for ($month = 1; $month < 12; $month++)
            {
                $data = $year . '-' . $month;
                $initial_date = $data . '-' . '01';
                $final_date = date("Y-m-t", strtotime($initial_date));

                $competencia = new Competencia($data, $initial_date, $final_date, 0);
                $this->repositorioCompetenia->save($competencia);
            }
        }
    }

}
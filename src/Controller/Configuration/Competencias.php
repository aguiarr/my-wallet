<?php


namespace Wallet\Controller\Configuration;


use Wallet\Model\Entity\Competencia;

class Competencias
{
    public function gerarComp()
    {
        for ($i = 2020; $i < 2050; $i++)
        {
            for ($j = 1; $j < 12; $j++)
            {
                $data = $i + '-' + $j;
                $competencia = new Competencia($data, 0, 0, 0);
            }
        }
    }

}
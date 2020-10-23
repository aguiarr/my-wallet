<?php


namespace Wallet\Controller\Despesas;


use Wallet\Controller\InterfaceController;
use Wallet\Model\Entity\Competencia;
use Wallet\Model\Entity\Despesa;
use Wallet\Model\Infrastructure\EntityManagerCreator;

class PersistenceDespesa implements  InterfaceController
{
    private $entityManager;
    private $repositorioCompetencia;
    private $repositorioDespesa;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCompetencia = $this->entityManager
            ->getRepository(Competencia::class);
        $this->repositorioDespesa = $this->entityManager
            ->getRepository(Despesa::class);
    }
    public function request(): void
    {
        $despesa = new Despesa();

        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

        if (is_null($descricao) || $descricao === false) {
            echo "Descricao Inválida";
            echo $descricao;
        } else {
            $despesa->setDescricao($descricao);
        }

        $valor = filter_input(
            INPUT_POST,
            'valor',
            FILTER_VALIDATE_FLOAT
        );

        if (is_null($valor) || $valor === false) {
            echo "Valor Inválido";
        } else {
            $despesa->setValor(floatval($valor));
        }

        $data = filter_input(
            INPUT_POST,
            'data',
            FILTER_SANITIZE_STRING
        );

        if (is_null($data) || $data === false) {
            echo "Data Inválida";
        } else {
            $despesa->setDate($data);
        }

        $formaPagamento = filter_input(
            INPUT_POST,
            'formaPagamento',
            FILTER_SANITIZE_STRING
        );
        if (is_null($formaPagamento) || $formaPagamento === false) {
            echo "Forma de Pagamento inválida.";
        } else {
            $despesa->setPagamento($formaPagamento);
        }

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );
        if (is_null($id) || $id === false) {
            $this->entityManager->persist($despesa);
        } else {
            $despesa->setId($id);
            $this->entityManager->merge($despesa);
        }

    //var_dump($this->repositorioCompetencia->findBy(array('competencia' =>  substr($data, 0, 7))));
        if ($this->repositorioCompetencia->findBy(array('competencia' =>  substr($data, 0, 7)))) {

            $competencia = $this->repositorioCompetencia->findBy(array('competencia' =>  substr($data, 0, 7)));


            $valorAnterior = $competencia->getDespesas();
            if (!is_null($id) || $id !== false) {
                $despesaEdit = $this->repositorioDespesa->find($id);
                $valor_despesa_anterior = $despesaEdit->getValor();

                $competencia->setDespesas($valorAnterior + ($valor - $valor_despesa_anterior));

                $this->entityManager->merge($competencia);
            }
            //var_dump($competencia);

        } else {
            $competencia = new Competencia(substr($data, 0, 7));
            $competencia->setDespesas($valor);
            $this->entityManager->persist($competencia);
            //var_dump($competencia);
        }

        $this->entityManager->flush();


        header('Location: /listar-despesas', true, 302);
    }
}
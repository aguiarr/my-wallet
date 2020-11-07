<?php

use Wallet\Controller\Bancos\AddBanco;
use Wallet\Controller\Bancos\EditBanco;
use Wallet\Controller\Bancos\ListarBanco;
use Wallet\Controller\Bancos\PersistenceBanco;
use Wallet\Controller\Bancos\RemoveBanco;
use Wallet\Controller\Competencias\GerarCompetencias;
use Wallet\Controller\Entradas\AddEntrada;
use Wallet\Controller\Despesas\EditDespesa;
use Wallet\Controller\Entradas\EditEntrada;
use Wallet\Controller\Despesas\AddDespesa;
use Wallet\Controller\MetodosPagamentos\AddFormaPagamento;
use Wallet\Controller\MetodosPagamentos\EditFormaPagamento;
use Wallet\Controller\MetodosPagamentos\ListarFormasPagamento;
use Wallet\Controller\MetodosPagamentos\PersistenceFormaPagamento;
use Wallet\Controller\MetodosPagamentos\RemoveFormaPagamento;
use Wallet\Controller\Home;
use Wallet\Controller\Despesas\ListarDespesas;
use Wallet\Controller\Entradas\ListarEntradas;
use Wallet\Controller\Despesas\PersistenceDespesa;
use Wallet\Controller\Entradas\PersistenceEntrada;
use Wallet\Controller\Despesas\RemoveDespesa;
use Wallet\Controller\Entradas\RemoveEntrada;

return [
    '/adicionar-despesa' => AddDespesa::class,
    '/adicionar-entrada' => AddEntrada::class,
    '/salvar-entrada' => PersistenceEntrada::class,
    '/salvar-despesa'=> PersistenceDespesa::class,
    '/listar-entradas' => ListarEntradas::class,
    '/listar-despesas'=> ListarDespesas::class,
    '/remover-despesa' => RemoveDespesa::class,
    '/remover-entrada' => RemoveEntrada::class,
    '/alterar-entrada' => EditEntrada::class,
    '/alterar-despesa' => EditDespesa::class,
    '/home' => Home::class,
    '/listar-bancos' => ListarBanco::class,
    '/adicionar-banco' => AddBanco::class,
    '/remove-banco' => RemoveBanco::class,
    '/salvar-banco' => PersistenceBanco::class,
    '/alterar-banco' => EditBanco::class,
    '/alterar-pagamentos' => EditFormaPagamento::class,
    '/adicionar-pagamentos' => AddFormaPagamento::class,
    '/remove-pagamentos' => RemoveFormaPagamento::class,
    '/salvar-pagamentos' => PersistenceFormaPagamento::class,
    '/listar-pagamentos' => ListarFormasPagamento::class,
    '/gerar-competencias' => GerarCompetencias::class
];
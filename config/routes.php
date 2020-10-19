<?php

use Wallet\Controller\Bancos\AddBanco;
use Wallet\Controller\Bancos\EditBanco;
use Wallet\Controller\Bancos\ListarBanco;
use Wallet\Controller\Bancos\PersistenceBanco;
use Wallet\Controller\Bancos\RemoveBanco;
use Wallet\Controller\Entradas\AddEntrada;
use Wallet\Controller\Despesas\EditDespesa;
use Wallet\Controller\Entradas\EditEntrada;
use Wallet\Controller\Despesas\AddDespesa;
use Wallet\Controller\FormaPagamentos\AddFormaPagamento;
use Wallet\Controller\FormaPagamentos\EditFormaPagamento;
use Wallet\Controller\FormaPagamentos\ListarFormasPagamento;
use Wallet\Controller\FormaPagamentos\PersistenceFormaPagamento;
use Wallet\Controller\FormaPagamentos\RemoveFormaPagamento;
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
    '/listar-pagamentos' => ListarFormasPagamento::class
];
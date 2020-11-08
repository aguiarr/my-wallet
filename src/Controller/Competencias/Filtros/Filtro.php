<?php

$con = mysqli_connect('127.0.0.1','root','','mywallet');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

function totalEntrada($con,$id)
{
    mysqli_select_db($con,"mywallet");
    $sql="SELECT * FROM entradas WHERE id_competencia = ". $id .";";
    $result = mysqli_query($con,$sql);

    $dataList = mysqli_fetch_all($result);

    foreach ($dataList as $data){
        $totalEntrada += floatval($data[1]);
    }
    if($totalEntrada == null) return 0;

    return $totalEntrada;
}

function totalDespesa($con,$id)
{
    mysqli_select_db($con,"mywallet");
    $sql="SELECT * FROM despesas WHERE id_competencia = ". $id .";";
    $result = mysqli_query($con,$sql);

    $dataList = mysqli_fetch_all($result);

    foreach ($dataList as $data){
        $totalDespesa += floatval($data[1]);
    }
    if($totalDespesa == null) return 0;

    return $totalDespesa;
}
$totalDespesa = totalDespesa($con, $id);
$totalEntrada = totalEntrada($con, $id);

if($totalDespesa === null || $totalEntrada === null ||$totalDespesa == $totalEntrada) $total = 0;
$total = $totalEntrada - $totalDespesa;

$arr = [$totalEntrada, $totalDespesa, $total];

echo json_encode($arr);

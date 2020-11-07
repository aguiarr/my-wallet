<?php require 'header.php';

    foreach ($entradas as $entrada):
        $totalEntradas +=  floatval($entrada->getValor());
    endforeach;

    foreach ($despesas as $despesa):
        $totalDespesas += floatval($despesa->getValor());
    endforeach;

    if ($totalDespesas >= $totalEntradas){
        $total = $totalDespesas - $totalEntradas;
        $situacao = 'Negativa';
        $cor = 'red';
    }else{
        $total = $totalEntradas - $totalDespesas;
        $situacao = 'Positiva';
        $cor = 'green';
    }
?>
<div class="container">
    <div class="info-div">
        <hr class="my-4">
        <div class="mb-4">
            <h3><b>Situação:</b></h3>
            <h4 style="color:<?=$cor?>;font-weight: bold"><?=$situacao?></h4>
        </div>
        <div class="total-div">
            <h5 for="">Total Atual:</h5>
            <div class="input-group mb-3">
                <input type="text" class="form-control" readonly value="<?= number_format($total,2,",",".")?>">
            </div>
        </div>
    </div>
    <!-- <div>
        <a href="/adicionar-despesa" class="btn btn-danger btn-lg btn-block mb-2">Adicionar Despesa</a>
        <a href="/adicionar-entrada" class="btn btn-success btn-lg btn-block mb-2">Adicionar Entrada</a>
    </div> -->
    <div class="info-div">
        <hr class="my-4">
        <div class="mb-4">
            <h3><b>Competência:</b></h3>
            <div class="">
                <select class="custom-select " id="inputGroupSelect01" name="banco" id="banco">
                    <option value="">Todos os Meses.</option>
                    <?php foreach ($competencias as $competencia):?>
                        <option value="<?=$competencia->getId();?>"><?=$competencia->getCompetencia();?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
    </div>
    <hr class="my-4">
    <div class="">
        <div class="despesa-div">
            <h5 for="">Despesas:</h5>
            <div class="input-group mb-3">
                <input type="text" class="form-control" readonly value="<?= number_format($totalDespesas,2,",",".")?>">
            </div>
        </div>
        <div class="entrada-div">
            <h5 for="">Entradas:</h5>
            <div class="input-group mb-3">
                <input type="text" class="form-control" readonly value="<?= number_format($totalEntradas,2,",",".")?>">
            </div>
        </div>
        <div class="total-div">
            <h5 for="">Total do Mês:</h5>
            <div class="input-group mb-3">
                <input type="text" class="form-control" readonly value="<?= number_format($total,2,",",".")?>">
            </div>
        </div>
        
        <hr class="my-5">
        <div class="total-div">
            <h5 for="">Total Atual:</h5>
            <div class="input-group mb-3">
                <input type="text" class="form-control" readonly value="<?= number_format($total,2,",",".")?>">
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
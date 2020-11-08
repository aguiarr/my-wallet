<?php require 'header.php'; ?>
<div class="container">
    <div class="info-div">
        <hr class="my-4">
        <div class="mb-4">
            <h3><b>Situação:</b></h3>
            <h4 style="color:<?=$situacao[1]?>;font-weight: bold"><?=$situacao[0]?></h4>
        </div>
        <div class="total-div">
            <h5 for="">Total Atual:</h5>
            <div class="input-group mb-3">
                <input type="text" class="form-control" readonly value="<?= number_format($total,2,",",".")?>">
            </div>
        </div>
    </div>
    <div class="info-div">
        <hr class="my-4">
        <div class="mb-4">
            <h3><b>Competência:</b></h3>
            <div class="">
                <select class="custom-select " id="select-comp" name="banco" id="banco">
                    <option>Selecione</option>
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
                <input type="text" class="form-control" id="despesas" readonly value="<?= number_format($totalDespesas,2,",",".")?>">
            </div>
        </div>
        <div class="entrada-div">
            <h5 for="">Entradas:</h5>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="entradas" readonly value="<?= number_format($totalEntradas,2,",",".")?>">
            </div>
        </div>
        <div class="total-div">
            <h5 for="">Total do Mês:</h5>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="total" readonly value="<?= number_format($total,2,",",".")?>">
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
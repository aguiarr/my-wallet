
<?php require __DIR__ . '/../header.php';?>

<form method="post" action="/salvar-entrada<?= isset($entrada) ? '?id=' . $entrada->getId() : '';?>" >
    <div class="container">
        <div>
            <hr class="my-4">
            <h2>Cadastrar Entrada</h2>
            <div class="input-group mb-2">
                <input name="valor" id="valor" type="text" class="form-control" placeholder="Valor da entrada." value="<?= isset($entrada) ? $entrada->getValor() : '';?>">
            </div>
            <div class="input-group mb-2">
                <textarea name="descricao" id="descricao" class="form-control" placeholder="Descrição da entrada." value=""><?= isset($entrada) ? $entrada->getDescricao() : '';?></textarea>
            </div>
            <div class="input-group mb-2">
                <input name="data" id="data" type="date" class="form-control" placeholder="Valor da entrada." aria-describedby="addon-wrapping" value="<?= isset($entrada) ? $entrada->getDate() : '';?>">
            </div>
        </div>
        <hr class="my-4">
        <div class="select-div">
            <h2>Forma de Recebimento</h2>
            <div class="input-group mb-3">
                <select class="custom-select" id="inputGroupSelect01" name="formaPagamento" id="formaPagamento" value="">
                    <option value=""><?= isset($entrada) ? $entrada->getPagamento() : 'Selecione';?></option>
                    <?php foreach ($formasPagamento as $forma):?>
                    <option value="<?=$forma->getNome();?>"><?= $forma->getNome();?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <h2>Banco</h2>
            <div class="input-group mb-3">
                <select class="custom-select " id="inputGroupSelect01" name="banco" id="banco">
                    <option value=""></option>
                    <?php foreach ($bancos as $banco):?>
                        <option value="<?=$banco->getNome();?>"><?= $banco->getNome();?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <hr class="my-4">
            <div>
                <input type="submit" class="btn btn-primary float-right" id="btnEntrada" value="Salvar Entrada">
            </div>
        </div>
    </div>
</form>
<?php require __DIR__ . '/../footer.php';?>

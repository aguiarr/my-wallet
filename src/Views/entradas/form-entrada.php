
<?php require __DIR__ . '/../header.php';?>

<form method="post" action="/salvar-entrada<?= isset($entrada) ? '?id=' . $entrada->getId() : '';?>" >
    <div class="container">
        <div>
            <hr class="my-4">
            <h2><?=$titulo?></h2>
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
            <h2>Forma de Pagamento</h2>
            <div class="input-group mb-3">
                <select class="custom-select" id="inputGroupSelect01" name="formaPagamento" id="formaPagamento">
                    <option value="<?= isset($entrada) ? $formaPagamento->getId() : null?>?>"><?=isset($entrada) ? $formaPagamento->getNome() : 'Selecione';?></option>
                    <?php foreach ($formasPagamento as $forma):?>
                        <option value="<?=$forma->getId();?>"><?= $forma->getNome();?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <h2>Banco</h2>
            <div class="input-group mb-3">
                <select class="custom-select " id="inputGroupSelect01" name="banco" id="banco">
                    <option value="<?= isset($entrada) ? $bancoAtual->getId(): null?>"><?=isset($entrada) ? $bancoAtual->getNome() : 'Selecione';?></option>
                    <?php foreach ($bancos as $banco):?>
                        <option value="<?=$banco->getId();?>"><?= $banco->getNome();?></option>
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

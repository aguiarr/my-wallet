
<?php require __DIR__ . '/../header.php';?>

<form method="post" action="/salvar-despesa<?= isset($despesa) ? '?id=' . $despesa->getId() : '';?>" >
    <div class="container">
        <div>
            <hr class="my-4">
            <h2><?=$titulo?></h2>
            <div class="input-group mb-2">
                <input name="valor" id="valor" type="text" class="form-control" placeholder="Valor da despesa." value="<?= isset($despesa) ? $despesa->getValor() : '';?>">
            </div>
            <div class="input-group mb-2">
                <textarea name="descricao" id="descricao" class="form-control" placeholder="Descrição da despesa." ><?= isset($despesa) ? $despesa->getDescricao() : '';?></textarea>
            </div>
            <div class="input-group mb-2">
                <input name="data" id="data" type="date" class="form-control" placeholder="Valor da despesa." aria-describedby="addon-wrapping" value="<?= isset($despesa) ? $despesa->getDate() : '';?>">
            </div>
        </div>
        <hr class="my-4">
        <div class="select-div">
            <h2>Forma de Pagamento</h2>
            <div class="input-group mb-3">
                <select class="custom-select" id="inputGroupSelect01" name="formaPagamento" id="formaPagamento">
                    <option value=""><?= isset($despesa) ? $despesa->getPagamento() : 'Selecione';?></option>
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
        </div>
        <hr class="my-4">
        <div>
            <input type="submit" class="btn btn-primary float-right" id="btnDespesa" value="Salvar Despesa">
        </div>
    </div>
</form>
<?php require __DIR__ . '/../footer.php';?>
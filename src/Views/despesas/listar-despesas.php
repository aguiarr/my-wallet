
<?php require __DIR__ . '/../header.php'; ?>
    <div class="container">
        <h1 class="mt-5"> <?= $titulo ?></h1>
        <div class="mt-5">
            <h3><b>Competência:</b></h3>
            <select class="custom-select" id="inputGroupSelect01" name="formaPagamento" id="formaPagamento">
                <option value="">Todos os meses.</option>
                <?php foreach ($competencias as $competencia):?>
                    <option value="<?=$competencia->getId();?>"><?=$competencia->getCompetencia();?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="table-responsive-sm mt-5">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Pagamento</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                </tr>
                </thead>
                <?php foreach ($despesas as $despesa):?>
                    <?php $forma = $formaPagamento->find($despesa->getMetodoPagamento());?>
                    <tbody>
                        <tr>
                            <td><?= $despesa->getDescricao()?></td>
                            <td><?= $despesa->getDate()?></td>
                            <td><?= $forma[0]->getNome()?></td>
                            <td>R$ <?= number_format($despesa->getValor(),2,",",".")?></td>
                            <td><a href="/alterar-despesa?id=<?= $despesa->getId();?>" class="btn btn-info btn-sm">Alterar</a></td>
                            <td><a href="/remover-despesa?id=<?= $despesa->getId();?>" class="btn btn-danger btn-sm">Excluir</a></td>
                        </tr>
                    </tbody>
                    <?php
                    $total += floatval($despesa->getValor());
                endforeach;
                ?>
                <thead>
                <tr>
                    <th scope="col">Valor Total:</th>
                    <th scope="col">________</th>
                    <th scope="col">________</th>
                    <th scope="col"><?="R$ " . number_format($total,2,",",".");;?>
                    </th>
                    <th scope="col">________</th>
                    <th scope="col">________</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
<?php require __DIR__ .'/../footer.php';?>
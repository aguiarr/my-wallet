<?php require __DIR__ . '/../header.php'; ?>
    <div class="container">
        <form method="post" action="/salvar-pagamentos<?= isset($onePagamento) ? '?id=' . $onePagamento->getId() : '';?>">
            <div>
                <hr class="my-4">
                <h2><?=$titulo?></h2>
                <div class="input-group mb-2">
                    <input name="nome" id="valor" type="text" class="form-control" placeholder="Nome."value="<?= isset($onePagamento) ? $onePagamento->getNome() : '';?>">
                </div>
                <div>
                    <input type="submit" class="btn btn-primary float-right mb-5" id="btnEntrada" value="Salvar">
                </div>
            </div>
        </form>
        <div class="table-responsive-sm mt-5">
            <table class="table table-striped my-5">
                <thead>
                <tr>
                    <th scope="col">Forma de Pagamento</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                </tr>
                </thead>
                <?php foreach ($colletionPagamento as $formasPagamentos): ?>
                <tbody>
                <tr>
                    <td><?=$formasPagamentos->getNome();?></td>
                    <td><a href="/alterar-pagamentos?id=<?= $formasPagamentos->getId();?>" class="btn btn-info btn-sm">Alterar</a></td>
                    <td><a href="/remove-pagamentos?id=<?= $formasPagamentos->getId();?>" class="btn btn-danger btn-sm">Excluir</a></td>
                </tr>
                </tbody>
                <?php
                endforeach;
                ?>
                <thead>
                <tr>
                    <th scope="col">________</th>
                    <th scope="col">________</th>
                    <th scope="col">________</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
<?php require __DIR__ . '/../footer.php'; ?>
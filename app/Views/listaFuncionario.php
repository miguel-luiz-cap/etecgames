<table class='table'>
    <thead>
        <th>Código</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Alterar</th>
        <th>Excluir</th>
    </thead>
    <tbody>
        <?php foreach ($funcionarios as $funcionario) : ?>
            <tr>
                <td> <?php echo ($funcionario->codFun) ?> </td>
                <td> <?php echo ($funcionario->nomeFun) ?> </td>
                <td> <?php echo ($funcionario->foneFun) ?> </td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarFunModal" codigo="<?php echo ($funcionario->codFun); ?>" nome='<?php echo ($funcionario->nomeFun) ?>' fone='<?php echo ($funcionario->foneFun) ?>'>Alterar</button>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarFunModal" codigo="<?php echo ($funcionario->codFun); ?>" nome='<?php echo ($funcionario->nomeFun) ?>' fone='<?php echo ($funcionario->foneFun) ?>'>Deletar</button>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<div class="modal fade" id="alterarFunModal" tabindex="-1" aria-labelledby="alterarFunModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="alterarFunModal">Alterar Funcionário</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="codFunAlterar" class="codigo form-control" id="codFun" readonly>
                    <div class="mb-3">
                        <label for="nome" class="col-form-label">Nome:</label>
                        <input type="text" name="nomeFun" class="nome form-control" id="nome">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="col-form-label">Telefone:</label>
                        <input type="text" name="foneFun" class="fone form-control" id="fone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deletarFunModal" tabindex="-1" aria-labelledby="deletarFunModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletarFunModal">Tem certeza que quer deletar o funcionario?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-footer">
                    <input type="hidden" name='codFun' value="<?php echo ($funcionario->codFun); ?>">
                    <button type="submit" class="btn btn-danger">Sim</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Não</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var alterarFunModal = document.getElementById('alterarFunModal')
    alterarFunModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var codigo = button.getAttribute('codigo')

        var nome = button.getAttribute('nome')
        var fone = button.getAttribute('fone')


        var Codigo = alterarFunModal.querySelector('.modal-body .codigo')
        Codigo.value = codigo

        var Nome = alterarFunModal.querySelector('.modal-body .nome')
        Nome.value = nome

        var Fone = alterarFunModal.querySelector('.modal-body .fone')
        Fone.value = fone
    })

    var deletarFunModal = document.getElementById('deletarFunModal')
    deletarFunModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        var codigo = button.getAttribute('codigo');
        var nome = button.getAttribute('nome');
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.

        var modalTitle = deletarFunModal.querySelector('.modal-title');
        modalTitle.textContent = 'Tem certeza que deseja excluir o funcionario ' + nome + '?';
    
        var Codigo = deletarFunModal.querySelector('.modal-footer .codigo');
        Codigo.value = codigo;

        //var Nome = alterarFunModal.querySelector('.modal-header .nome');
        //Nome.value = nome;
    })
</script>
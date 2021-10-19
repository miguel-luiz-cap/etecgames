<table class='table'>
	<thead>
		<th>Código</th>
		<th>Nome</th>
		<th>Email</th>
		<th>Telefone</th>
		<th>Alterar</th>
		<th>Excluir</th>
	</thead>
	<tbody>
		<?php foreach ($fornecedores as $fornecedor) : ?>
			<tr>
				<td> <?php echo ($fornecedor->codForn) ?> </td>
				<td> <?php echo ($fornecedor->nomeForn) ?> </td>
				<td> <?php echo ($fornecedor->emailForn) ?> </td>
				<td> <?php echo ($fornecedor->foneForn) ?> </td>
				<td>
					<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarFornModal" 
					codigo="<?php echo ($fornecedor->codForn); ?>" 
					nome='<?php echo ($fornecedor->nomeForn); ?>'
					email='<?php echo ($fornecedor->emailForn); ?>'
					telefone='<?php echo ($fornecedor->foneForn); ?>'>
						Alterar
					</button>
				</td>
				<td>
					<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarFornModal" codigo="<?php echo ($fornecedor->codForn); ?>" nome='<?php echo ($fornecedor->nomeForn) ?>'>Deletar</button>
				</td>

			</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<div class="modal fade" id="alterarFornModal" tabindex="-1" aria-labelledby="alterarFornModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="alterarFornModal">Alterar informações do fornecedor:</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST">
				<div class="modal-body">
					<input type="hidden" name="codFornAlterar" class="codigo form-control" id="codfornecedor" readonly>
					<div class="mb-3">
						<label for="nome" class="col-form-label">Nome:</label>
						<input type="text" name="nomeForn" class="nome form-control" id="nome">
					</div>
					<div class="mb-3">
						<label for="email" class="col-form-label">Email:</label>
						<input type="text" name="emailForn" class="email form-control" id="email">
					</div>
					<div class="mb-3">
						<label for="telefone" class="col-form-label">Telefone:</label>
						<input type="text" name="foneForn" class="telefone form-control" id="telefone">
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

<div class="modal fade" id="deletarFornModal" tabindex="-1" aria-labelledby="deletarFornModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deletarFornModal">Tem certeza que quer deletar o fornecedor?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST">
				<div class="modal-footer">
					<input type="hidden" class="codigo" name='codForn'>
					<button type="submit" class="btn btn-danger">Sim</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Não</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	var alterarFornModal = document.getElementById('alterarFornModal')
	alterarFornModal.addEventListener('show.bs.modal', function(event) {
		var button = event.relatedTarget
		var codigo = button.getAttribute('codigo')
		var nome = button.getAttribute('nome')
		var email = button.getAttribute('email')
		var telefone = button.getAttribute('telefone')

		var Codigo = alterarFornModal.querySelector('.modal-body .codigo')
		Codigo.value = codigo

		var Nome = alterarFornModal.querySelector('.modal-body .nome')
		Nome.value = nome

		var Email = alterarFornModal.querySelector('.modal-body .email')
		Email.value = email

		var Telefone = alterarFornModal.querySelector('.modal-body .telefone')
		Telefone.value = telefone
	})

	var deletarFornModal = document.getElementById('deletarFornModal')
	deletarFornModal.addEventListener('show.bs.modal', function(event) {
		var button = event.relatedTarget;
		var codigo = button.getAttribute('codigo');
		var nome = button.getAttribute('nome');

		var modalTitle = deletarFornModal.querySelector('.modal-title');
		modalTitle.textContent = 'Tem certeza que deseja excluir o fornecedor ' + nome + '?';
	
		var Codigo = deletarFornModal.querySelector('.modal-footer .codigo');
		Codigo.value = codigo;
	})
</script>
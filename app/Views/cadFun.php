<form method="POST" class='border border-primary rounded p-4'>
<?php 
$codusuario = isset($usuario->codusu) ? $usuario->codusu : null;

if($codusuario && $codusuario!=null) :
?>
	<div class="mb-3">
		<label for="nome" class="form-label">Código Usuario</label>
		<input type="text" class="form-control" id="codigo" readonly name="codusu_FK" value="<?php echo ($codusuario); ?>">
	</div>
	<div class="mb-3">
		<label for="nome" class="form-label">Nome</label>
		<input type="text" class="form-control" id="nome" aria-describedby="nomeHelp" name="nomeFun">
		<div id="nomeHelp" class="form-text">Nome do funcionario</div>
	</div>
	<div class="mb-3">
		<label for="senha" class="form-label">Telefone</label>
		<input type="text" class="form-control" aria-describedby="telHelp"  id="telefone" name="foneFun">
		<div id="telHelp" class="form-text">xxxx-xxxx</div>
	</div>
	<button type="submit" class="btn btn-primary">Cadastrar</button>
	
<?php else : ?>

	<div>
        <label for='codusu' class='form-label'>Digite o Código do usuário para poder promover para funcionário</label>
        <input type='number' name='codUsu' id='codusu' class='form-control' placeholder='Exemplo: 123' />
    </div>

    <div class='col-12 mt-4'>
        <button type='submit' class='btn btn-primary'>Buscar</button>
    </div>
<?php endif ?>

</form>



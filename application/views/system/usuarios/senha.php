<?php
$this->load->view('sistema/tpl/header');
?>
<div class="content-header">
	<div class="content-header-title">Sistema - Trocar Senha - <?=first_name($user->nome); ?></div>
	<div class="content-header-row"></div>
	<div class="content-header-options">
		<div class="btn-group">
			<a class="btn" href="javascript:history.go(-1);">
				<i class="icon-arrow-left"></i> 
				Voltar
			</a>
		</div>
	</div>
</div>

<form action="<?=current_url(); ?>" method="post">
	<div class="modal content-edit">
		<div class="modal-header">
			<h3>Trocar Senha</h3>
		</div>
		<div class="modal-body">
			<p>

				<div class="input-append">
					<label>Senha:</label>
					<input type="password" name="form_senha" onkeyup="javascript:Admin.sistema.verifySenha(this);" value="" maxlength="16" class="span2">
					<span class="add-on">Caracteres permitidos: a-z A-Z 0-9 * # ! @</span>
				</div>
			</p>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-success" />Alterar</button>
			<a href="javascript:void(0);" class="btn" onclick="javascript:history.go(-1);" />Cancelar</a>
			</form>
		</div>
	</div>
	<input type="hidden" name="id" value="<?=$user->id; ?>">
</form>
<?php
$this->load->view('sistema/tpl/footer');
?>
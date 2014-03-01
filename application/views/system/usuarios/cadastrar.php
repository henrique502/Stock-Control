<?php
$this->load->view('sistema/tpl/header');

?>
<div class="content-header">
	<div class="content-header-title">Sistema - Usuários - Cadastrar</div>
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


<div class="content-forms">
	<form action="<?=current_url(); ?>" method="post" id="main_form">
		<fieldset>
			<table>
				<tr>
					<td width="150">Nome: *</td>
					<td><input type="text" name="form_nome" value="" maxlength="60" class="span2"></td>
				</tr>
				<tr>
					<td>E-mail: *</td>
					<td class="input-append">
						<input type="text" name="form_email" onkeyup="javascript:Admin.sistema.verifyEmail(this);" value="" maxlength="60" class="span2">
						<span class="add-on"></span>
					</td>
				</tr>
				<tr>
					<td>Senha: *<br><small>{a-z A-Z 0-9 * # ! @}</small></td>
					<td class="input-append">
						<input type="password" name="form_senha" onkeyup="javascript:Admin.sistema.verifySenha(this);" value="" maxlength="16" class="span2">
						<span class="add-on"></span>
					</td>
				</tr>
				<tr>
					<td>Permissões:</td>
					<td>
						<?php
						foreach($permissoes as $perm){
							echo '
								<label class="checkbox inline">
									<input type="checkbox" name="form_permissao[',$perm->flag,']" value="',$perm->id,'">
									',$perm->descricao,'
								</label>
								<br>
							';
						}
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<br>
						<button type="submit" class="btn btn-success submit" data-loading-text="Processando...">
							<i class="icon-plus icon-white"></i> Cadastrar
						</button>
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</div>
<?php
$this->load->view('sistema/tpl/footer');

?>
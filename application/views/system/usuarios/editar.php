<?php
$this->load->view('sistema/tpl/header');
?>
<div class="content-header">
	<div class="content-header-title">Sistema - Usuários - <?=first_name($user->nome); ?></div>
	<div class="content-header-row"></div>
	<div class="content-header-options">
		<div class="btn-group">
			<a class="btn" href="javascript:history.go(-1);">
				<i class="icon-arrow-left"></i> 
				Voltar
			</a>
			<a class="btn btn-danger" href="<?=site_url('sistema/usuarios/remover/'.$user->id); ?>">
				<i class="icon-trash icon-white"></i>
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
					<td><input type="text" name="form_nome" value="<?=$user->nome; ?>" maxlength="60" class="span2"></td>
				</tr>
				<tr>
					<td>Permissões:</td>
					<td>
						<?php
						foreach($permissoes as $permissao){
							echo '
								<label class="checkbox inline">
									<input type="checkbox" ',(in_array($permissao->id,$perm) ? 'checked="checked"' : ''),' name="form_permissao[',$permissao->flag,']" value="',$permissao->id,'">
									',$permissao->descricao,'
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
							<i class="icon-ok icon-white"></i> Salvar
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
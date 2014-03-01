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
		</div>
	</div>
</div>
<form action="<?=current_url(); ?>" method="post">
	<div class="modal content-remove">
		<div class="modal-header">
			<h3>Remover Usuário</h3>
		</div>
		<div class="modal-body">
			<p>Você realmente gostaria de remover este usuário?</p>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-danger submit" data-loading-text="Processando..." />Remover</button>
			<a href="javascript:void(0);" class="btn" onclick="javascript:history.go(-1);" />Cancelar</a>
		</div>
	</div>
	<input type="hidden" name="id" value="<?=$user->id; ?>">
</form>
<script type="text/javascript">
	$('.submit').click(function(){
		$(this).button('loading');
	});
</script>
<?php
$this->load->view('sistema/tpl/footer');
?>
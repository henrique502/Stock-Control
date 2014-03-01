<?php
$this->load->view('sistema/tpl/header');

?>
<div class="content-header">
	<div class="content-header-title">Sistema - Usuários</div>
	<div class="content-header-search">
		<form action="<?=site_url('sistema/usuarios/search'); ?>" target="_self" method="post" class="form-horizontal">
			<div class="control-group">
			<div class="controls">
				<div class="input-append">
					<input class="span3" name="q" size="16" value="<?=isset($search) ? $search : ''; ?>" maxlength="50" type="text" placeholder="Procurar...">
					<button class="btn" type="submit"><i class="icon-search"></i></button>
				</div>
			</div>
			</div>
		</form>
	</div>
	<div class="content-header-row"></div>
	<div class="content-header-options">
		<div class="btn-group">
			<a class="btn" href="<?=site_url('sistema/usuarios/cadastrar'); ?>">
				<i class="icon-plus"></i> 
				Cadastrar um usuário
			</a>
		</div>
	</div>
</div>
<div class="content-table">
	<table class="table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Nome</th>
				<th>E-mail</th>
				<th width="150">Criado em</th>
				<th width="140">Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(sizeof($usuarios) > 0){
			foreach($usuarios as $rows){
				echo '
					<tr>
						<td>',$rows->nome,'</td>
						<td>',$rows->email,'</td>
						<td align="center">',date("d/m/Y H:i",$rows->ctime),'</td>
						<td align="center">
							<div class="btn-group">
								<a href="',site_url('sistema/usuarios/editar/'.$rows->id),'" class="btn btn-primary"><i class="icon-pencil icon-white"></i></a>
								<a href="',site_url('sistema/usuarios/trocar-senha/'.$rows->id),'" class="btn btn-primary"><i class="icon-lock icon-white"></i></a>
							';
							if($this->auth->get('id') == $rows->id){
								echo '<a href="javascript:void(0);" class="btn btn-danger disabled" title="Você não pode se remover!"><i class="icon-trash icon-white"></i></a>';
							} else {
								echo '<a href="',site_url('sistema/usuarios/remover/'.$rows->id),'" class="btn btn-danger"><i class="icon-trash icon-white"></i></a>';
							}
							echo '
								
							</div>
						</td>
					</tr>
				';
			}
		} else {
			echo '
				<tr>
					<td colspan="4" align="center">Nenhum registro encontrado!</td>
				</tr>
			';
		}
		?>
		</tbody>
	</table>
</div>
<div class="content-pages pagination">
	<ul><?=isset($pages) ? $pages : ''; ?></ul>
</div>
<?php
$this->load->view('sistema/tpl/footer');

?>
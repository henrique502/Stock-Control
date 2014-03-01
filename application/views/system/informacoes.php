<?php
$this->load->view('sistema/tpl/header');
?>
<div class="content-header">
	<div class="content-header-title">Sistema - Informações</div>
	<div class="content-header-row"></div>
</div>
<div class="content-table">
	<table class="table-striped table-bordered">
		<thead>
			<tr>
				<th>Bibliotecas</th>
				<th width="100">Status</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>CodeIgniter</td>
				<td align="center"><?=CI_VERSION; ?></td>
			</tr>
			<tr>
				<td>cURL</td>
				<td align="center"><?=extension_loaded('curl') ? '<span class="status-ok">Ok</span>' : '<span class="status-erro">Falha</span>'; ?></td>
			</tr>
			<tr>
				<td>GD</td>
				<td align="center"><?=function_exists('gd_info') ? '<span class="status-ok">Ok</td>' : '<span class="status-erro">Falha</span>'; ?></td>
			</tr>
		</tbody>
	</table>
</div>
<?php
if(sizeof($info) > 0){
	foreach($info as $titulo => $infos){
		echo '
			<div class="content-header">
				<div class="content-header-title">',@htmlentities($titulo),'</div>
				<div class="content-header-row"></div>
			</div>
			<div class="content-table">
				<table class="table-striped table-bordered">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody>
		';
		foreach($infos as $nome => $valor){
			echo '
						<tr>
							<td>',@htmlentities($nome),'</td>
							<td>',@htmlentities($valor),'</td>
						</tr>
			';
		}
		echo '
					</tbody>
				</table>
			</div>
		';
	}
}
$this->load->view('sistema/tpl/footer');

?>
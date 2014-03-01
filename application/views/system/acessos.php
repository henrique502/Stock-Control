<?php
$this->load->view('sistema/tpl/header');

?>
<div class="content-header">
	<div class="content-header-title">Sistema - Logs de Acessos</div>
	<div class="content-header-row"></div>
</div>
<div class="content-table">
	<table class="table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th width="170">IP</th>
				<th width="170">Tempo</th>
				<th width="170">Data</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(sizeof($acessos) > 0){
			foreach($acessos as $rows){
				echo '
					<tr>
						<td>',$rows->id,'</td>
						<td>',!empty($rows->nome) ? $rows->nome : '-- Usuário deletado --','</td>
						<td align="center">',$rows->ip == '::1' ? 'localhost' : $rows->ip,'</td>
						<td align="center">',time_ago($rows->ctime),'</td>
						<td align="center">',date("d/m/Y H:i",$rows->ctime),'</td>
					</tr>
				';
			}
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
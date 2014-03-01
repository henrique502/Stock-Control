<?php
$this->load->view('sistema/tpl/header');

?>
<div class="content-header">
	<div class="content-header-title">Sistema - Logs de Ações</div>
	<div class="content-header-row"></div>
</div>
<div class="content-table">
	<table class="table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th width="120">IP</th>
				<th width="120">Ação</th>
				<th width="170">Tabela</th>
				<th width="150">Tempo</th>
				<th width="150">Data</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(sizeof($logs) > 0){
			foreach($logs as $rows){
				echo '
					<tr>
						<td>',$rows->id,'</td>
						<td>',!empty($rows->nome) ? $rows->nome : '-- Usuário deletado --','</td>
						<td align="center">',$rows->ip == '::1' ? 'localhost' : $rows->ip,'</td>
						<td align="center">',ucwords($rows->acao),'</td>
						<td align="center">',$rows->tabela,'</td>
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
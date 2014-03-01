<center>
	<div style="margin-top:24px">
		<img src="<?=base_url('assets/img/cliente-140x60.png'); ?>" alt="<?=$this->config->item('cliente'); ?>">
	</div>
	<table style="width:480px;background:#e8eced;padding:10px;margin-bottom:24px;margin-top:24px" cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td style="background:#fff;border:1px solid #dce1e2">
				<table cellspacing="0" cellpadding="0" border="0" style="padding:32px 34px 34px;width:100%;background-color:#fff">
					<tr>
						<td>
							<big style="color:#395052;font-size:14px;letter-spacing:-0.3px;line-height:20px">Olá <?=$nome; ?>,</big>
							<br>
							<div style="color:#000;">
								Guarde esse e-mail ele tem seu acesso para o painel <?=$this->config->item('cliente'); ?>.
								<br><br>
								Usuário: <?=$user; ?><br>
								Senha: <?=$password; ?> <small>(Senha temporária)</small>
								<br><br>
								Seu usuário é <strong><?=$user; ?></strong>
							</div>
							<br>
							<div>
								<a href="<?=site_url('login'); ?>" style="text-align:center;width:160px;min-height:30px;background-color:#00aa00;border:1px solid #136f00;display:inline-block;line-height:30px;text-decoration:none;color:#fff;font-size:14px" target="_blank">Acessar</a>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</center>
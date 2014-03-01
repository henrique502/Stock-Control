<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="google" content="notranslate">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
<link rel="shortcut icon" type="image/png" href="<?=base_url('favicon.png'); ?>">
<link rel="stylesheet" type="text/css" href="<?=assets_url('css/bootstrap.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?=assets_url('css/ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?=assets_url('css/admin.css'); ?>">
<script type="text/javascript">var URL = {base: '<?=assets_url(); ?>',site: '<?=site_url(); ?>',current: '<?=current_url(); ?>'};</script>
<script type="text/javascript" src="<?=assets_url('js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?=assets_url('js/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?=assets_url('js/cms.js'); ?>"></script>
<script type="text/javascript" src="<?=assets_url('js/encode.js'); ?>"></script>
<script type="text/javascript" src="<?=assets_url('js/admin.js'); ?>"></script>
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<title><?=EMPRESA; ?> - Sistema de gerenciamento de conteúdo</title>
</head>
<body>
<div class="response"><?=display_error(); ?></div>
<header>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="center">
				<div class="pull-left">
					<a class="brand" href="<?=site_url(); ?>"><?=EMPRESA; ?></a>
					<ul class="nav">
						<?=$this->load->view('sistema/tpl/menu'); ?>
					</ul>
				</div>
				<div class="pull-right">
					<div class="btn-group">
						<?php if($this->auth->hasFlag('root')){ ?>
						<a class="btn" title="Editar meus dados" href="<?=site_url('sistema/usuarios/editar/'.$this->auth->get('id')); ?>"><?=first_name($this->auth->get('nome')); ?></a>
						<?php } else { ?>
						<a class="btn disabled"><?=first_name($this->auth->get('nome')); ?></a>
						<?php } ?>
						<a class="btn" title="Desconectar" href="<?=site_url('auth/unset'); ?>"><i class="icon-off"></i></a>
						<?php if($this->auth->hasFlag('root')){ ?>
							<button class="btn dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a <?=menu_url('sistema/usuarios'); ?> >Usuários</a></li>
								<li><a <?=menu_url('sistema/informacoes'); ?> >Informações</a></li>
								<li><a <?=menu_url('sistema/logs'); ?> >Logs de Ações</a></li>
								<li><a <?=menu_url('sistema/acessos'); ?> >Logs de Acessos</a></li>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<section>

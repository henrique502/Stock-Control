<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="google" content="notranslate">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
<link rel="shortcut icon" type="image/png" href="<?=base_url('favicon.png'); ?>">
<link rel="stylesheet" type="text/css" href="<?=assets_url('css/bootstrap.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?=assets_url('css/error.css'); ?>">
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<title><?=EMPRESA; ?> - Sistema de gerenciamento de conteúdo</title>
</head>
<body>
<div class="modal e404">
	<div class="modal-header">
		<h3>404</h3>
	</div>
	<div class="modal-body">
		<p>Página não encontrada</p>
	</div>
	<div class="modal-footer">
		<div class="btn-group">
			<a href="<?=site_url(); ?>" class="btn btn-mini">Página inícial</a>
			<a href="javascript:void(0);" class="btn btn-mini" onclick="javascript:history.go(-1);">Voltar</a>
		</div>
	</div>
</div>
</body>
</html>

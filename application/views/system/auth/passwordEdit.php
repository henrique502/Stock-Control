<!DOCTYPE html>
<html lang="pt-br">
<head>

	<title><?=$this->config->item('cliente'); ?> :: Alterar Senha</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="imagetoolbar" content="no">
<meta name="google" content="notranslate">
<meta name="content-language" content="pt-br">

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/login.css'); ?>">

<script type="text/javascript">var URL = {base: '<?=base_url(); ?>',site: '<?=site_url(); ?>',current: '<?=current_url(); ?>'};</script>
<script type="text/javascript" src="<?=base_url('assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.js'); ?>"></script>

<!--[if lt IE 9]><script src="https//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>
<body>
<section class="main-container">
	<div class="logo">
		<img src="<?=base_url('assets/img/cliente-140x60.png'); ?>" alt="<?=$this->config->item('cliente'); ?>">
	</div>
	
	<!-- Alerts -->
	<?=$this->alert->display(); ?>

	<div class="panel panel-default">
		<div class="panel-heading"><?=$this->config->item('cliente'); ?></div>
		<div class="panel-body">
			<form action="" method="post" id="login-form" role="form">
				<div class="form-group has-feedback">
					<label for="inputPassword">Digite sua nova senha</label>
					<input type="password" class="form-control" id="inputPassword" name="password" maxlength="16">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<label for="inputPasswordRepita">Repita a nova senha</label>
					<input type="password" class="form-control" id="inputPasswordRepita" name="repeat" maxlength="16">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Alterar</button>
				</div>
			</form>
		</div>
	</div>
	<div class="developer">
		Desenvolvido por <a href="http://www.hrdev.com.br/" target="_blank">HR Web Development</a>
	</div>
</section>
</body>
</html>
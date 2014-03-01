<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class HR_Alert {
	
	private $ci = null;

	const Sucesso = 'alert-success';
	const Info = 'alert-info';
	const Aviso = 'alert-warning';
	const Erro = 'alert-danger';

	public function __construct(){
		$this->ci =& get_instance();
	}

	public function add($msg,$classe = 2,$close = true){
		switch ($classe) {
			case 1 : $classe = self::Sucesso; break;
			case 2 : $classe = self::Info; break;
			case 3 : $classe = self::Aviso; break;
			case 4 : $classe = self::Erro; break;
			default: return;
		}
		$this->ci->session->set_flashdata('alert', array(
			'msg' => $msg,
			'class' => $classe,
			'close' => $close
		));
	}

	public function display(){
		$alert = $this->ci->session->flashdata('alert');
		if($alert){
			$html = '<div class="alert alert-dismissable '.$alert['class'].'">';
			if($alert['close'])
				$html .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			
			$html .= $alert['msg'];
			$html .= '</div>';
			echo $html;
		}
	}
}
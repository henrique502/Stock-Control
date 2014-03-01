<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class HR_Alert {
	
	private $ci = null;
	
	private $alert = false;

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
		
		$this->alert = array(
			'msg' => $msg,
			'class' => $classe,
			'close' => $close
		);
		
		$this->ci->session->set_flashdata('alert',$this->alert);
	}

	public function display(){
		if(!is_array($this->alert))
			$this->alert = $this->ci->session->flashdata('alert');
		
		if($this->alert){
			$html = '<div class="alert alert-dismissable '.$this->alert['class'].'">';
			if($this->alert['close'])
				$html .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			
			$html .= $this->alert['msg'];
			$html .= '</div>';
			
			$this->alert = false;
			$this->ci->session->set_flashdata('alert',false);
			
			echo $html;
			
		}
	}
}
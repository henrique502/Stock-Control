<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class HR_System extends CI_Session {
	
	private $ci = null;
	private $status = false;
	private $flags = array();
	private $uri = null;
	private $current_url = null;

	const FLAG_ROOT = 'root';
	const LOGIN_URI = 'login';
	const PASSWORD_URI = 'password';

	public function __construct(){
		parent::__construct();
		$this->ci =& get_instance();
		$this->uri = $this->ci->uri->segment(1);
		$this->current_url = current_url();
		if(!$this->alloc_session()){
			if($this->uri !== self::LOGIN_URI && $this->uri !== self::PASSWORD_URI){
				redirect(self::LOGIN_URI . '?go=' . rawurlencode($this->current_url));
			}
		}
	}

	public function is_auth(){
		return $this->status;
	}

	public function has_flag($flag){
		if(in_array($this->flags, self::FLAG_ROOT))
			return true;

		if(is_array($flag)){
			foreach($flag as $f){
				if(in_array($this->flags, $f))
					return true;
			}
		} else {
			if(in_array($this->flags, $flag))
				return true;
		}

		return true;
	}


	private function alloc_session(){
		$data = $this->userdata('usuario');
		if($data === false)
			return false;

		if(!isset($data['flags']))
			return false;

		if(!isset($data['status']))
			return false;

		$flags = explode('|',$data['flags']);
		if(sizeof($flags) == 0)
			return false;
		
		$status = $data['status'];
		if($status !== 1)
			return false;

		$this->flags = $flags;
		$this->status = true;

		return true;
	}
}
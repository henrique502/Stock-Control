<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model {	

	function __construct(){
		parent::__construct();
	}

	function getAccountByResetPasswordCode($code){
		return $this->db->select('id, email, newPasswordCode as code, newPasswordExpired as time')
			->from('usuarios')
			->where(array(
				'newPasswordCode =' => $code,
				'status =' => 1 
			))
			->get()->row();
	}

	function getAccountByEmail($email){
		return $this->db->select('id, nome, email, username')
			->from('usuarios')
			->where(array(
				'email =' => $email,
				'status =' => 1 
			))
			->get()->row();
	}

	function setNewPasswordCode($id,$code,$time){
		$this->db->update('usuarios',array(
			'newPasswordCode' => $code,
			'newPasswordExpired' => $time
		),'id = ' . $id . ' and status = 1');
	}
	
	function getAccountByLogin($data){
		return $this->db->select('id, username, nome, permissoes, forceNewPassword')
			->from('view_login')
			->where(array(
				'username =' => $data['username'],
				'password =' => system_password($data['password'])
			))
			->get()->row();
	}
	
	function updatePassowrd($id,$new_password){
		$this->db->update('usuarios',array(
			'newPasswordCode' => '',
			'newPasswordExpired' => 0,
			'forceNewPassword' => 0,
			'password' => system_password($new_password)
		),'id = ' . $id . ' and status = 1');
	}






}

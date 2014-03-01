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












	/* Acessos */
	function getAcessos($page = 0){
		return $this->db->select('acessos.id, acessos.ip, acessos.ctime, usuarios.nome')
			->from(TABLE_PREFIX.'_admin_logs_acessos as acessos')
			->join(TABLE_PREFIX.'_admin_usuarios as usuarios','acessos.usuario = usuarios.id','left outer')
			->order_by('acessos.ctime','desc')
			->limit(20,$page)
			->get()->result();
	}
	function getAcessosNum(){
		return $this->db->select('acessos.id')
			->from(TABLE_PREFIX.'_admin_logs_acessos as acessos')
			->join(TABLE_PREFIX.'_admin_usuarios as usuarios','acessos.usuario = usuarios.id','left outer')
			->get()->num_rows();
	}

	/* Logs */
	function getLogs($page = 0){
		return $this->db->select('acoes.id, acoes.ip, acoes.tabela, acoes.acao, acoes.ctime, usuarios.nome')
			->from(TABLE_PREFIX.'_admin_logs_acoes as acoes')
			->join(TABLE_PREFIX.'_admin_usuarios as usuarios','acoes.usuario = usuarios.id','left outer')
			->order_by('acoes.ctime','desc')
			->limit(20,$page)
			->get()->result();
	}
	function getLogsNum(){
		return $this->db->select('acoes.id')
			->from(TABLE_PREFIX.'_admin_logs_acoes as acoes')
			->join(TABLE_PREFIX.'_admin_usuarios as usuarios','acoes.usuario = usuarios.id','left outer')
			->get()->num_rows();
	}

	/* Usuarios */
	function getUsuarios($page = 0){
		return $this->db->select('id, nome, email, ctime')
			->from(TABLE_PREFIX.'_admin_usuarios')
			->order_by('nome','desc')
			->limit(20,$page)
			->get()->result();
	}
	function getUsuariosNum(){
		return $this->db->select('id')
			->from(TABLE_PREFIX.'_admin_usuarios')
			->get()->num_rows();
	}
	function getUsuariosSearch($page = 0,$search = ''){
		return $this->db->select('id, nome, email, ctime')
			->from(TABLE_PREFIX.'_admin_usuarios')
			->or_like(array(
				'nome' => $search,
				'email' => $search
			))
			->order_by('nome','desc')
			->limit(20,$page)
			->get()->result();
	}
	function getUsuariosSearchNum($search = ''){
		return $this->db->select('id')
			->from(TABLE_PREFIX.'_admin_usuarios')
			->or_like(array(
				'nome' => $search,
				'email' => $search
			))
			->get()->num_rows();
	}
	function getUsuario($id){
		return $this->db->select('id, nome, email, ctime')
			->from(TABLE_PREFIX.'_admin_usuarios')
			->where('id =',$id)
			->limit(1,0)
			->get()->row();
	}
	function getUsuarioByEmail($email){
		return $this->db->select('id, nome, email, ctime')
			->from(TABLE_PREFIX.'_admin_usuarios')
			->where('email =',$email)
			->limit(1,0)
			->get()->row();
	}
		
	function insertUsuario($post){
		$this->db->insert(TABLE_PREFIX.'_admin_usuarios',$post);
		$id = $this->db->insert_id();
		$this->logs->register();
		return $id;
	}
	function updateUsuario($id,$dados){
		$this->db->update(TABLE_PREFIX.'_admin_usuarios',$dados,"id = '{$id}'");
		$this->logs->register();
	}
	function deleteUsuario($id){
		$this->db->delete(TABLE_PREFIX.'_admin_usuarios',"id = '{$id}'");
		$this->logs->register();
	}

	function insertPermission($uid,$pid){
		$this->db->insert(TABLE_PREFIX.'_admin_permission',array(
			'flag' => $pid,
			'usuario' => $uid
		));
		$this->logs->register();
	}
	function cleanPermission($uid){
		$this->db->delete(TABLE_PREFIX.'_admin_permission',"usuario = '{$uid}'");
	}

	function getPermission(){
		return $this->db->select('id, flag, descricao')
			->from(TABLE_PREFIX.'_admin_flags')
			->get()->result();
	}
	
	function getUserByAuth($email,$senha){
		return $this->db->select('id, nome, email')
			->from(TABLE_PREFIX.'_admin_usuarios')
			->where(array(
				'email =' => $email,
				'senha =' => $senha
			))
			->limit(1,0)
			->get()->row();
	}
	function getUserPermissionByID($id){
		return $this->db->select('flags.id, flags.flag')
			->from(TABLE_PREFIX.'_admin_flags AS flags')
			->join(TABLE_PREFIX.'_admin_permission AS perm','flags.id = perm.flag','inner')
			->join(TABLE_PREFIX.'_admin_usuarios AS usuarios','perm.usuario = usuarios.id','inner')
			->where('usuarios.id =',$id)
			->get()->result();
	}





}

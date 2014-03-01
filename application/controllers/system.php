<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System extends CI_Controller {
	
	/* Login :: /login */
	public function login(){
		$this->load->model('system_model','model');

		if(is_post()){
			$data = array(
				'username' => strtolower(trim($this->input->post('user'))),
				'password' => $this->input->post('password'),
			);
	
			if(preg_match(SYSTEM_USERNAME_FORMAT, $data['username']) && preg_match(SYSTEM_PASSWORD_FORMAT, $data['password'])){
				$account = $this->model->getAccountByLogin($data);
				if($account){
					if($account->forceNewPassword == 1){
						$code = $this->geratePasswordCode($account->id);
						redirect("password/edit?code=" . $code);
					}
					
					$this->system->login($account);
					
					$go = $this->input->get('go');
					if(!empty($go))
						redirect($go);
					
					redirect(site_url());
				} else {
					$this->alert->add('Usuário e/ou senha inválidos.',4);
				}
			} else {
				$this->alert->add('Usuário e/ou senha inválidos 1.',4);
			}
		}

		$this->load->view('system/auth/login');
	}

	/* Esqueceu a senha? :: /password/new */
	public function passwordNew(){
		$this->load->model('system_model','model');
		if(is_post()){
			$email = strtolower($this->input->post('email'));
			if(preg_match(EMAIL_FORMAT, $email)){

				$account = $this->model->getAccountByEmail($email);
				if($account){
					$code = $this->geratePasswordCode($account->id);

					$this->load->library('email',array('mailtype' => 'html'));
					$this->email->from($this->config->item('cliente_email'), $this->config->item('cliente'));
					$this->email->to($account->email);
					$this->email->subject($this->config->item('cliente') . ' :: Pedido de nova senha');
					$this->email->message($this->load->view('system/emails/reset-password',array(
						'nome' => $account->nome,
						'user' => $account->username,
						'code' => $code
					),true));

					if($this->email->send()){
						$this->alert->add('Foi enviado um e-mail para você.',1);
					} else {
						$this->alert->add('Erro ao enviar e-mail.',4);
					}
					redirect('password/new');
				} else {
					$this->alert->add('E-mail não encontrado.',4);
				}
			} else {
				$this->alert->add('E-mail inválido.',4);
			}
		}
		$this->load->view('system/auth/passwordNew');
	}

	/* Alterar Senha :: /password/edit?code={40} */
	public function passwordEdit(){
		$this->load->model('system_model','model');
		$time = time();
		$code = $this->input->get('code');
		if(preg_match(SYSTEM_PASSWORD_CODE_FORMAT,$code)){
			$account = $this->model->getAccountByResetPasswordCode($code);
			if($account){
				$time_left = $account->time - $time;
				if($time_left >= 0){
					if(is_post()){
						$new_password = $this->input->post('password');
						if(preg_match(SYSTEM_PASSWORD_FORMAT, $new_password)){
							$repeat_password = $this->input->post('repeat');
							if($new_password === $repeat_password){
								$this->model->updatePassowrd($account->id,$new_password);
								$this->alert->add('Senha alterada com sucesso!',1);
								redirect("login");
							} else {
								$this->alert->add('As senhas nâo são iguais.',3);
							}
						} else {
							$this->alert->add('Senha deve ter 6 a 16 caracteres e estar no seguinte formato: a-z, A-Z, 0-9, @, ! e/ou #',3);
						}
					}
					$this->load->view('system/auth/passwordEdit',array(
						'account' => $account
					));
				} else {
					$this->alert->add('Seu link expirou.',3);
					redirect('login?expired=1');
				}
			} else { redirect('login?code-not-found=1'); }
		} else { show_404(); }
	}

	/* Logoff :: /logoff */
	public function logoff(){
		$this->system->logoff();
		
		redirect("login");
	}
	
	private function geratePasswordCode($id){
		$this->load->helper('string');
		
		$expire = strtotime('+24 hours');
		$code = random_string('alnum', 40);
		
		$this->model->setNewPasswordCode($id,$code,$expire);
		
		return $code;
	}
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	/* Default */

	public function dashboard(){
		
		$this->load->view('system/home');
	}
	
	public function notfound(){
		show_404();
	}





	



/*

	public function usuarios($pages = 0){
		$this->auth->verify('root');
		$this->load->model('sistema_model','model');
		
		$pagination = $this->main_model->pages(array(
			'uri_segment' => 3,
			'base_url' => site_url('sistema/usuarios'),
			'total_rows' => $this->model->getUsuariosNum(),
			'per_page' => 20,
		));
		$this->load->view('sistema/usuarios/lista',array(
			'pages' => $pagination,
			'usuarios' => $this->model->getUsuarios()
		));
	}

	public function search($search = '',$page = 0){
		$this->auth->verify('root');
		$this->load->model('sistema_model','model');

		if($this->input->post('q')){
			$search = strtourl($this->input->post('q'));
			redirect('sistema/usuarios/search/'.$search);
		} elseif(!empty($search)){
			$pagination = $this->main_model->pages(array(
				'uri_segment' => 5,
				'base_url' => site_url('sistema/usuarios/search/'.$search),
				'total_rows' => $this->model->getUsuariosSearchNum($search),
				'per_page' => 20,
			));
			$this->load->view('sistema/usuarios/lista',array(
				'pages' => $pagination,
				'usuarios' => $this->model->getUsuariosSearch($page,$search),
				'search' => str_replace('-',' ',$search)
			));
		} else {
			redirect('sistema/usuarios');
		}
	}

	public function usuarioscadastrar(){
		$this->auth->verify('root');
		$this->load->model('sistema_model','model');
		if($this->input->post()){
			$post = array(
				'nome' => $this->input->post('form_nome'),
				'email' => strtolower($this->input->post('form_email')),
				'senha' => sha1($this->input->post('form_senha')),
				'ctime' => time()
			);

			if($this->verifyEmailBoolean()){
				
				$id = $this->model->insertUsuario($post);
				$perm = $this->input->post('form_permissao');
				if(sizeof($perm) > 0){
					foreach($perm as $flag){
						$this->model->insertPermission($id,$flag);
					}
				}
				
				alert('Usuário cadastrado com sucesso','success');
				redirect('sistema/usuarios');
			}
		}
		$this->load->view('sistema/usuarios/cadastrar',array(
			'permissoes' => $this->model->getPermission()
		));
	}
	public function usuarioseditar($id = false){
		$this->auth->verify('root');
		$this->load->model('sistema_model','model');
		if($id){
			if($id === 'self'){
				$id = $this->auth->get('id');
			}
			$user = $this->model->getUsuario($id);
			if($this->input->post()){
				$post = array(
					'nome' => $this->input->post('form_nome'),
				);
				$id = $this->model->updateUsuario($user->id,$post);
				$this->model->cleanPermission($user->id);
				$perm = $this->input->post('form_permissao');
				if(sizeof($perm) > 0){
					foreach($perm as $flag){
						$this->model->insertPermission($user->id,$flag);
					}
				}
				alert('Usuário editado com sucesso','success');
				redirect('sistema/usuarios');
			}
			$perm = array();
			foreach($this->model->getUserPermissionByID($user->id) as $p){
				array_push($perm,$p->id);
			}
			$this->load->view('sistema/usuarios/editar',array(
				'user' => $user,
				'perm' => $perm,
				'permissoes' => $this->model->getPermission()
			));
		} else { show_404(); }
	}
	public function usuariosremover($id = false){
		$this->auth->verify('root');
		$this->load->model('sistema_model','model');
		if($id && $id != $this->auth->get('id')){
			$user = $this->model->getUsuario($id);
			if($this->input->post('id')){
				$this->model->deleteUsuario($user->id);
				alert('Usuário removido com sucesso','success');
				redirect('sistema/usuarios');
			}
			$this->load->view('sistema/usuarios/remover',array(
				'user' => $user
			));
		} else { show_404(); }
	}

	public function changePassword($id = false){
		$this->auth->verify('root');
		$this->load->model('sistema_model','model');
		if($id){
			if($id === 'self'){
				$id = $this->auth->get('id');
			}
			$user = $this->model->getUsuario($id);
			if($this->input->post()){
				$post = array(
					'senha' => sha1($this->input->post('form_senha'))
				);
				$this->model->updateUsuario($id,$post);
				alert('Senha alterada com sucesso','success');
				redirect('sistema/usuarios');
			}
			$this->load->view('sistema/usuarios/senha',array(
				'user' => $user
			));
		} else { show_404(); }
	}




	public function verifyEmail(){
		if($this->input->post()){
			$this->auth->verify('root');
			$email = strtolower(base64_decode($this->input->post('paramOne')));
			
			$json = array('code' => 404,'erro' => '');

			if(!empty($email) && preg_match(EMAIL_FORMAT,$email)){
				$this->load->model('sistema_model','model');
				$user = $this->model->getUsuarioByEmail($email);
				if(isset($user->id)){
					$json = array('code' => 500,'erro' => 'E-mail em uso por outro usuário');
				} else {
					$json['code'] = 200;
				}
			} else {
				$json = array('code' => 500,'erro' => 'E-mail no formato inválido');
			}
			echo json_encode($json);
		} else { show_404(); }
	}
	private function verifyEmailBoolean(){
		if($this->input->post()){
			$this->auth->verify('root');
			$email = strtolower($this->input->post('form_email'));
			if(!empty($email) && preg_match(EMAIL_FORMAT,$email)){
				$this->load->model('sistema_model','model');
				$user = $this->model->getUsuarioByEmail($email);
				if(isset($user->id)){
					return false;
				} else {
					return true;
				}
			} else {
				return false;
			}
		} else { show_404(); }
	}


	public function logs($page = 0){
		$this->auth->verify('root');
		$this->load->model('sistema_model','model');
		$pagination = $this->main_model->pages(array(
			'uri_segment' => 3,
			'base_url' => site_url('sistema/logs'),
			'total_rows' => $this->model->getLogsNum(),
			'per_page' => 20,
		));
		$this->load->view('sistema/logs',array(
			'pages' => $pagination,
			'logs' => $this->model->getLogs($page)
		));
	}
	public function acessos($page = 0){
		$this->auth->verify('root');
		$this->load->model('sistema_model','model');
		$pagination = $this->main_model->pages(array(
			'uri_segment' => 3,
			'base_url' => site_url('sistema/acessos'),
			'total_rows' => $this->model->getAcessosNum(),
			'per_page' => 20,
		));
		$this->load->view('sistema/acessos',array(
			'pages' => $pagination,
			'acessos' => $this->model->getAcessos($page)
		));
	}
	public function informacoes(){
		$this->auth->verify('root');
		$this->load->helper('phpinfo');
		$this->load->view('sistema/informacoes',array(
			'dirs' => array(
				'./assets'

			),
			'info' => phpinfo_array()
		));
	}

 */
}
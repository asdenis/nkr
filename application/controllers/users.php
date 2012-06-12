<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('date');
	}

	function index()
	{
		$this->_is_logged_in();
	}

	function login()
	{
		$data['title'] = 'Acceso';
		$data['main_content'] = 'users/login';
		$this->load->view('includes/template', $data);
	}		

	function join()
	{
		$data['title'] = 'Nueva Cuenta';
		$data['main_content'] = 'users/registro';
		$this->load->view('includes/template', $data);
	}

	function retry_password()
	{
		
	}

	function verify_login()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$login = $this->users_model->verify_login($username, $password);
		if ($login)
		{
			$data = array(
							'is_logged_in' => TRUE,
							'nombre' => $login[0]->user,
							'user_id' => $login[0]->id
						);
			$this->session->set_userdata($data);

			/*$titulo = $this->session->userdata('nombre');
			$data = array();
			$data['main_content'] = 'ejtragos';
			$data['title'] = 'Bienvenido '.$titulo;
			$this->load->view('includes/template', $data);*/

			redirect('dashboard');
		}
		else
		{
			$this->login();
		}
	}


	function logout ()
	{
		$this->session->sess_destroy();
		redirect(users/login);
	}

	function create_acount()
	{
		$this->form_validation->set_rules('username', 'Usuario', 'trin|required|min_length[5]|max_length[12]|callback__username_check');
		$this->form_validation->set_rules('correo', 'Correo', 'trin|required|valid_email|callback__email_check');
		$this->form_validation->set_rules('password', 'Password', 'trin|required|md5');
		$this->form_validation->set_rules('repassword', 'Confirmar Password', 'trin|required|matches[password]|md5');
		
		$this->form_validation->set_message('required', 'El campo %s es requerido');
		$this->form_validation->set_message('valid_email', 'El campo %s no es valido');
		$this->form_validation->set_message('_username_check', 'El campo %s ya existe');
		$this->form_validation->set_message('_email_check', 'El campo %s ya existe');
		$this->form_validation->set_message('matches', 'Las passwords no coinciden');

		if ($this->form_validation->run() == FALSE)
		{
			$this->join();
		}
		else
		{
			$username = $this->input->post('username');
			$correo = $this->input->post('correo');
			$password = $this->input->post('password');
			$activation_code = $this->_random_string(10);
			$password = $this->input->post('password');

			$now = time();
			$gmt = unix_to_human($now, TRUE, 'eu');

			$insert = $this->users_model->insert_user($username, $correo, $password, $activation_code, $gmt);

			//email confirmacion

			$config = array(
							'protocol' => 'smtp',
							'smtp_host' => 'ssl://smtp.googlemail.com', 
							'smtp_port' => 465, 
							'smtp_user' => 'adriansdenis@gmail.com', 
							'smtp_pass' => 'adriansdenis2185',
							'mailtype' => 'html'
							);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");


			//configuracion del correo
			$this->email->from('noockers@denislab.com', 'noockers');
			$this->email->to($correo);
			$this->email->subject('Verificacion de Registro en Noockers');
			$this->email->message('Por favor verifique su registro '.anchor('http://nkr.nindeo.com/users/register_confirm/'.$activation_code, 'Valida tu correo'));
			//$this->email->send();

			if ($this->email->send())
			{
				echo 'Email enviado correctamente!!';
			}
			else
			{
				show_error($this->email->print_debugger());
			}

		}
	}

	function register_confirm($activation_code = '')
	{
		if ($activation_code == '')
		{
			die('Codigo de verificacion no aceptado');
		}
		else
		{
			$update = $this->users_model->confirm_registration($activation_code);
			if ($update) 
			{
				echo 'Registro Completo';
			}
			else
			{
				echo 'Su verificacion de registro fallo';
			}
		}
	}

	function _username_check($username)
	{
		return $this->users_model->username_check($username);
	}

	function _email_check($email)
	{
		return $this->users_model->email_check($email);
	}

	function _random_string($length)
	{
		$base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
		$max = strlen($base) -1;
		$activation_code = '';
		while (strlen($activation_code) < $length) 
		$activation_code .= $base{mt_rand(0, $max)};
		return $activation_code;
	}

	function username_check_ajax()
	{
		//echo $this->input->post('nombre_usuario');
		//echo 'llego';

		if($this->input->is_ajax_request())
		{
			$username = $this->input->post('nombre_usuario');
			if ($this->users_model->username_check($username))
			{
				echo 'ok';
			}
			else
			{
				echo 'El campo ya Existe';
			}
		}
		else
		{
			echo 'acceso denegado';
		}
	}

	function _is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if ($is_logged_in != true)
		{
			redirect('users/login');
			//$this->login();
		}
		else
		{
			redirect('dashboard');
		}
	}

}

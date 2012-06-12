<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data['main_content'] = 'login';
		$data['title'] = 'Login';
		$this->load->view('includes/template', $data);
	}

	function loged()
	{
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			echo "cargo el form";
		}
	}
}
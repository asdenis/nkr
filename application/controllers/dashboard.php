<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->_is_logged_in();
	}

	function index()
	{
	}

	function panel()
	{
		$data['main_content'] = 'dashboard/index';
		$data['title'] = 'Dashboard';
		$this->load->view('includes/template', $data);
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
			$this->panel();
		}
	}
}

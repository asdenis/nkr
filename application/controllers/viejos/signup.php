<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['main_content'] = 'signup';
		$this->load->view('registro',$data);
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {
	//ejemplo de un metodo con argumentos
	public function users($nombre = "")
	{
		$this->load->view('mensaje');
	}

	public function index()
	{

		$this->load->model('drinks_model');
		$data['drinks'] = $this->drinks_model->display_drinks();
		$data['comments'] = $this->drinks_model->display_comments();
		$data['title'] = 'noockers';
		$data['main_content'] = 'drinks/index';
		$this->load->view('includes/template', $data);
	}
}
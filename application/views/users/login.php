<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	$atributos = array('id' => 'form_log');
	echo form_open('users/verify_login', $atributos);

	$usuario = array(
					'name' 	=> 'username',
					'class' => 'input_form',
					'type' 	=> 'text',
					'value' => ''
					);
	$pass = array(
					'name' 	=> 'password',
					'class' => 'input_form',
					'type' 	=> 'password',
					'value' => ''
					);
	$enviar = array(
					'name' 	=> 'submit',
					'class' => 'btn_form',
					'type' 	=> 'submit',
					'value' => 'LogIn'
					);

	echo form_label('Usuario: ');
	echo form_input($usuario);
	echo form_label('Password: ');
	echo form_input($pass);

	echo form_submit($enviar);

	echo anchor('users/join', 'Click aca para registrarte');

	echo form_close();

?>
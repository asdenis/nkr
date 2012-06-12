<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	$atributos = array('id' => 'form_reg');
	echo form_open('users/create_acount', $atributos);

	$usuario = array(
					'name' 	=> 'username',
					'id' 	=> 'username',
					'class' => 'input_form',
					'type' 	=> 'text',
					'value' => set_value('username')
					);
	$correo = array(
					'name' 	=> 'correo',
					'id' 	=> 'correo',
					'class' => 'input_form',
					'type' 	=> 'mail',
					'value' => set_value('correo')
					);
	$correo = array(
					'name' 	=> 'correo',
					'id' 	=> 'correo',
					'class' => 'input_form',
					'type' 	=> 'text',
					'value' => set_value('correo')
					);
	$enviar = array(
					'name' 	=> 'submit',
					'class' => 'btn_form',
					'type' 	=> 'submit',
					'value' => 'Regitrar'
					);

	echo form_input($usuario);
	echo form_input($correo);
	echo form_textarea($mensaje);
	echo form_submit($enviar);

	echo form_close();

	echo validation_errors();

?>
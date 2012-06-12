<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Model extends CI_Model {

	function username_check($username)
	{
		$this->db->where('user', $username); //select
		$query = $this->db->get('users'); //tabla
		if($query->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function email_check($email)
	{
		$this->db->where('correo', $email); //select
		$query = $this->db->get('users'); //tabla
		if($query->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function insert_user($username, $correo, $password, $activation_code, $gmt)
	{
		$data = array(
						'user' => $username,
						'correo' => $correo,
						'password' => $password,
						'activacion_code' => $activation_code,
						'fecha' => $gmt,
					);

		return $this->db->insert('users', $data);
	}
	
	function confirm_registration($activation_code)
	{
		$this->db->select('id');
		$this->db->where('activacion_code', $activation_code);
		$query = $this->db->get('users');
		if($query->num_rows() > 0)
		{
			$data = array('status' => 1 );
			$this->db->where('activacion_code', $activation_code);
			return $this->db->update('users', $data);
		}
		else
		{
			return false;
		}

	}

	function verify_login($username, $password)
	{
		$this->db->where('user', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('users');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

}
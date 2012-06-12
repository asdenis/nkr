<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drinks_Model extends CI_Model {

	function display_drinks()
	{
		$query = $this->db->query('SELECT drinks.drink, drinks.fecha, drinks.img, users.user FROM users INNER JOIN drinks ON drinks.user_id = users.id ORDER BY drink');
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		else
		{
			return false;
		}
	}

	function display_comments()
	{
		$query = $this->db->query('SELECT users.user, users.img, comments.comentario, drinks.drink, comments.fecha FROM comments INNER JOIN users ON comments.user_id = users.id INNER JOIN drinks ON comments.drink_id = drinks.id ORDER BY fecha DESC');
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		else
		{
			return false;
		}
	}

}
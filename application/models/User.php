<?php
Class User extends CI_Model{
	function register($new_user){
		$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?,NOW(),NOW())";
		$values = [$new_user['first_name'], $new_user['last_name'], $new_user['email'], $new_user['password']];
		return $this->db->query($query, $values);
	}
	function login($user){
		$query = "SELECT * FROM users WHERE email=? AND password=?";
		$values = array($user['email'], $user['password']);
		$validator = $this->db->query($query,$values)->row_array();
		if ($validator == 0){
			return false;
		} else{
			return $validator;
		}
	}
}
?>
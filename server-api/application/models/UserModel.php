<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	// auth user
	public function auth ($login, $password) {

		$query = $this->db->query ("
			SELECT `id`, `login`
			FROM `users`
			WHERE `login` = ?
			AND `password` = ?
			LIMIT 1",
		[$login, $password]);

		if ($query->num_rows () > 0) {

			$user = $query->row();

			// generate new token
			$generateToken = md5(time ()."-".md5($login)."-".md5($password)."-".time());

			// update token
			$this->db->query ("UPDATE `users` SET `token` = ? WHERE `id` = ?", [$generateToken, $user->id]);
			$user -> token = $generateToken;

			return $user;


		}

		else return false;

    }

}
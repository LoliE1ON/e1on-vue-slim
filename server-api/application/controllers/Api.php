<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	// generate json
	private function generateResponce ($apperData) {

		$data = new stdClass ();
		$data -> time = time ();
		$data -> status = "error";
		$data -> message = "Something went wrong...";

		$data = (object) array_merge ((array) $data, (array) $apperData);
		return json_encode ($data);

	}

	// get token
	public function Auth_getToken () {

		$data = new stdClass ();

		$_POST = json_decode(file_get_contents('php://input'), true);

		$login  = $this->input->post ("login") ?? null;
		$password  = $this->input->post ("password") ?? null;

		if (!empty ($login) and !empty ($password)) {

			$this->load->model ("UserModel");
			$auth = $this->UserModel->auth ($login, $password);

			if (isset ($auth -> token)) {
				$data -> status = "successfully";
				$data -> message = "You are logged in";
				$data -> user = $auth;
			} else {
				$data -> status = "error";
				$data -> message = "Login or password incorrect";
			}

		}

		echo $this->generateResponce($data);

    }
    
	// get vrchat world
	public function Vrchat_getWorld () {

		$data = new stdClass ();

		$_POST = json_decode(file_get_contents('php://input'), true);
		$worldId  = $this->input->post ("worldId") ?? null;

		if (!empty ($worldId)) {

			$this->load->library ("curl");
            
            $curl = $this->curl;
            $responce = $curl->setUrl ("https://api.vrchat.cloud/api/1/worlds/".$worldId."?apiKey=JlE5Jldo5Jibnk5O5hTx6XVqsJu4WJ26")->getQuery ();
            $api = json_decode($responce);

			if (isset ($api->name)) {
				$data -> status = "successfully";
				$data -> message = "OK";
				$data -> world = $api;
			} else {
				$data -> status = "error";
				$data -> message = "...";
			}

		}

		echo $this->generateResponce($data);

    }
    
}
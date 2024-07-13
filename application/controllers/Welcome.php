<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

class Welcome extends CI_Controller {

	public function index()
	{
		echo 'r';
	}

	public function checkDbConnection()
	{
		$this->load->database();

		if($this->db->conn_id)
		{
			echo "Database Connection Successfully";
		}
		else
		{
			echo "Database Not Connected";
		}
	}

	public function checkLoadModels()
	{
        $this->load->model('Load_model', 'loader');

		$this->loader->loadModels();

		echo $this->app_users->test();

	}
}

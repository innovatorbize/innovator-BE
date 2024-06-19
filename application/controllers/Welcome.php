<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		echo base_url();
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

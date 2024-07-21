<?php

class Welcome extends CI_Controller {

	public function index()
	{
		echo 'r';
	}

    public function getDailyfacts() {
        $query = $this->db->get('daily_facts');
        $data = $query->result();
        return $query;
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

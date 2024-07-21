<?php

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Load_model', 'loader');
		$this->loader->loadModels();

    }

	public function index()
	{
		echo 'r';
	}

    public function getDailyfacts() {
        $query = $this->db->get('daily_facts');
        $data = $query->result();
        // $this->loader->sendresponse($data);
		print_r(json_decode($data));

        // return $data;
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

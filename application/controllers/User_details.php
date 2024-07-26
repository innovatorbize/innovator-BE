<?php

class User_details extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Load_model', 'loader');
		$this->loader->loadModels();
		// $this->load->library('user_agent');

    }

	public function index()
	{
		$result = array();
		$ci = get_instance();
		$ci->load->library('user_agent');
		$agent = $ci->agent;

		$result['agent_string'] = $agent->agent_string();
		$result['platform'] = $agent->platform();
		$result['browser'] = $agent->browser();
		$result['version'] = $agent->version();
		$result['robot'] = $agent->robot();
		$result['mobile'] = $agent->mobile();
		$result['referrer'] = $agent->referrer();
		$result['is_referral'] = $agent->is_referral();
		$result['languages'] = $agent->languages();
		$result['charsets'] = $agent->charsets();
		// $result['ip_address'] = $this->get_client_ip();

		print_r(json_encode($result));
	}

	// public function get_client_ip() {
	// 	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
	// 		$ip = $_SERVER['HTTP_CLIENT_IP'];
	// 	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
	// 		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	// 	} else {
	// 		$ip = $_SERVER['REMOTE_ADDR'];
	// 	}
	// 	return $ip;
	// };

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

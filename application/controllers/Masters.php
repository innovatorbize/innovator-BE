<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

class Masters extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Load_model', 'loader');
        $this->load->model('app_logs_model', 'app_logs');
		$this->loader->loadModels();
        $this->load->helper('jwt_helper');
    }

	public function savetests()
	{
        $userData = json_decode(file_get_contents('php://input'), true);
        $userData = (object)$userData;
        $id = isset($userData->id) ? $userData->id : null;
        if(!isset($id))
        {
            $id = $this->tests->saveTests($userData);
        }
        else
        {
            $id = $this->tests->updateTests($userData);
        }
        $this->loader->sendresponse($id);
	}

    public function testsList()
	{
        $getData =(object)$this->input->get();
        $data = $this->db->query("select * from tests;")->result();
        $this->loader->sendresponse($data);
    }

    public function editTests()
	{
        $id = json_decode(file_get_contents('php://input'), true);
        // $getData =(object)$this->input->get();
        $data = $this->db->query("select * from tests where id = $id;")->row_array();
        $this->loader->sendresponse($data);
    }

    public function deleteTests()
	{
        $id = json_decode(file_get_contents('php://input'), true);
        $data = $this->tests->deleteTests($id);
        $this->loader->sendresponse($data);
    }

    public function updateformData($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('public_issues', $data);
        return $data;
    }

    public function getAllData() {
        $query = $this->db->get('public_issues');
        $data = $query->result();
        return $query;
    }


	public function checkLoadModels()
	{
        $this->load->model('Load_model', 'loader');
		$this->loader->loadModels();
		echo $this->app_users->test();

	}
}

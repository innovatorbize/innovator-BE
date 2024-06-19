<?php

class Auth extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Load_model', 'loader');
		$this->loader->loadModels();
    }

    public function saveSignUp()
    {
        $postData = (object)$this->input->post();
        // $postData = json_decode(file_get_contents('php://input'), true);

        if($postData){
            $user = $this->app_users->saveAppUsers($postData);
        }
        else{
            $user = null;
        }
    }
	
}

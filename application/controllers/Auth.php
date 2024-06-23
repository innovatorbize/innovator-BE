<?php

class Auth extends CI_Controller {

    private $key = "Rej";

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Load_model', 'loader');
		$this->loader->loadModels();
        $this->load->helper('jwt_helper');
    }

    public function saveSignUp()
    {
        $userData = (object)$this->input->post();
        $userData = json_decode(file_get_contents('php://input'), true);

		$userData = array(
            'username' => 'prem',
            'password' => 'kojo',
            'email' => 'prem@email.dev',
            'phone_no' => '8908978900' 
        );

        if($userData){
            $id = $this->app_users->saveAppUsers((object)$userData);
        }

        if($id)
        {
            $response['status'] = 'Registration SucessFully';
            $response['result'] = $id;
        }
        else
        {
            $response['status'] = 'Signup Error';
        }

        $this->loader->sendresponse($response);
    }

    public function login()
    {
        $loginData = (object)$this->input->post();
        $loginData = json_decode(file_get_contents('php://input'), true);

        $loginData = array(
            'password' => 'kojo',
            'email' => 'prem@email.dev',
        );

        $loginData =(object)$loginData;

        if($loginData)
        {
            $checkUser = $this->app_users->checkLoggedUser($loginData);

            if($checkUser)
            {
                $userData = $this->app_users->getUserData('email', $loginData->email);
                $jwt = new JWT();
                $token = array(
                    'id' => $userData->id,
                    'email' => $userData->email,
                    'exp' => time() + 3600  
                );
                $jwt = $jwt->encode($token, $this->key, 'HS256');
            }
        }

        if($checkUser)
        {
            $response['status'] = 'Login SucessFully';
            $response['result'] = $jwt;
        }
        else
        {
            $response['status'] = 'Signin Error';
        }

        $this->loader->sendresponse($response);
    }

    public function scheckUser()
    {
        $checkEmail = $this->app_users->checkUser();

        echo $checkEmail;
    }

}

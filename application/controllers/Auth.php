<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 3600");

class Auth extends CI_Controller {

    private $key = "Rej";

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Load_model', 'loader');
        $this->load->model('app_logs_model', 'app_logs');
		$this->loader->loadModels();
        $this->load->helper('jwt_helper');

    }

    public function saveSignUp()
    {
        $getData = json_decode(file_get_contents('php://input'), true);

        $userData = new stdClass;

        $userData = (object)$getData;

        $oldUserData = new stdClass;

        $filterType = 'email';

        $oldUserData = $this->app_users->getUserData($filterType, $userData->email);

        if($userData){
            if($oldUserData->email !== $userData->email && $oldUserData->phone_no !== $userData->phone_no)
            {
                $id = $this->app_users->saveAppUsers($userData);
                $response['log'] = true;
                $response['status'] = 'Registration SucessFully';
                $response['result'] = $id;
            }
            else
            {
                $response['log'] = false;
                $response['status'] = 'Signup Error';
                $response['result'] = 'Email or Phone No Already Exits';
            }
        }
        else
        {
            $response['status'] = 'Signup Error';
            $response['result'] = 'Retry the login';
        }

        $this->loader->sendresponse($response);
    }

    public function login()
    {
        // $loginData = (object)$this->input->post();
        // $loginData = json_decode(file_get_contents('php://input'), true);

        $loginData = array(
            'password' => 'kojo',
            'email' => 'prem@email.dev',
            'phone_no' => '8908978900'
        );

        $loginData =(object)$loginData;

        // var_dump($loginData);

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
            $response['log'] = true;
            $response['status'] = 'Login SucessFully';
            $response['jwt'] = $jwt;
        }
        else
        {
            $response['log'] = false;
            $response['status'] = 'Signin Error';
        }

        $this->loader->sendresponse($response);
    }

}

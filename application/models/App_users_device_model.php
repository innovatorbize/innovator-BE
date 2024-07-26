<?php

class App_users_device_model extends CI_Model {
    
    public $table = 'app_users_device';

    private $key = "Rej";

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function quries()
    {
        $quries = array();

        $quries[] = "CREATE TABLE `innovator_bize`.`app_users` (`id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `hpassword` VARCHAR(255) NOT NULL , `salt` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `phone_no` VARCHAR(12) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    }

    public function generate_salt($length = 32) 
    {
        return bin2hex(random_bytes($length));
    }

    public function hash_password($password, $salt) 
    {
        return hash('sha256', $salt . $password);
    }

    public function checkUserData($type = '', $filter)
    {
        $user_data = $this->db->get_where($this->table, array($type => $filter))->row_array();
        
        if($user_data && sizeof($user_data) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
       
    }

    public function getUserData($type = '', $filter)
    {
        $user_data = $this->db->get_where($this->table, array($type => $filter))->row();
        if($user_data)
        {
            return $user_data;
        }
        else
        {
            return '';
        }
    }

    public function checkUser()
    {
        $getAuthUser = $this->authenticate();
        $checkEmail = $this->app_users->getUserData('email', $getAuthUser->email);

        if(isset($checkEmail->email))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
   
    public function saveAppUsers($userData) 
    {
        $salt = $this->generate_salt();
        $hash_password = $this->hash_password($userData->password, $salt);
        $userData->salt = $salt;
        $userData->hpassword = $hash_password;
        
        $id = $this->db->insert($this->table, $userData);

        return $id;
    }

    public function checkLoggedUser($loginData)
    {
        $login_email = $loginData->email;
        $login_password = $loginData->password;
        $userData = $this->getUserData('email', $login_email);
        $check_email = $this->checkUserData('email', $login_email);

        if($userData !== '')
        {
            $salt = $userData->salt;
            $password = $userData->hpassword;
    
            $login_hpassword = $this->hash_password($login_password, $salt);
    
            if($check_email && $login_hpassword === $password)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }

    }

    public function authenticate() {
        $headers = $this->input->request_headers();
        if (isset($headers['Authorization'])) 
        {
            $token = str_replace('Bearer ', '', $headers['Authorization']);
            $jwt = new JWT();
            try {
                $decoded = $jwt->decode($token, $this->key, true);
                return (object) $decoded;
            } catch (Exception $e) {
                $this->output
                     ->set_content_type('application/json')
                     ->set_status_header(401)
                     ->set_output(json_encode(array('error' => 'Unauthorized')));
                return false;
            }
        }
        else {
            $this->output
                 ->set_content_type('application/json')
                 ->set_status_header(401)
                 ->set_output(json_encode(array('error' => 'Unauthorized')));
            return false;
        }
    }

    public function test()
    {
        echo $this->generate_salt();
    }

}

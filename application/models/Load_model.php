<?php

class Load_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
   
    public function loadModels() {
         
        $models = array();

        $models = [
            'app_users',
            'app_logs',
            'tests'
        ];

        foreach($models as $m)
        {
            $this->load->model($m.'_model', $m);
        }
    }

    public function sendresponse($data=null)
    {
        if($data)
        {
            $response['status'] = '';
            $response['result'] = $data;
            print_r(json_encode($response));
        }
        else
        {
            $response['status'] = '';
            $response['result'] = [];
            print_r(json_encode($response));
        }
    }

}

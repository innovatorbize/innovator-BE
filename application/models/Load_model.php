<?php

class Load_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
   
    public function loadModels() {
         
        $models = array();

        $models = [
            'app_users'
        ];
        
        foreach($models as $m)
        {
            $this->load->model($m.'_model', $m);
        }
    }

}

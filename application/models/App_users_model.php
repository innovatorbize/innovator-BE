<?php

class App_users_model extends CI_Model {
    
    protected $table = 'app_users';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
   
    public function saveAppUsers($data) {
        $id = $this->db->insert($table, $data);
        return $id;
    }

    public function test()
    {
        echo 'app_users';
    }

}

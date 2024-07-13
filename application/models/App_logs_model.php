<?php

class App_logs_model extends CI_Model {
    
    public $table = 'app_logs';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function quries()
    {
        $quries = array();

        $quries[] = "";
    }

    public function test()
    {
        echo 'r';
    }

}

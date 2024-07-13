<?php

class Tests_model extends CI_Model {
    
    public $table = 'tests';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function quries()
    {
        $quries = array();
        $quries[] = "CREATE TABLE `innovator_bize`.`tests` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `status` INT NOT NULL , `created_by` INT NOT NULL , `updated_by` INT NOT NULL , `created_time` VARCHAR(255) NOT NULL , `updated_time` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    }

    public function saveTests($saveData=null)
    {
        $save = new StdClass;
        $save->name = $saveData->name;
        $save->status = $saveData->status['code'];
        $id = $this->db->insert($this->table, $save);
        return $id;
    }

    public function updateTests($updateData=null)
    {
        $updateData->status = $updateData->status['code'];
        $id = $this->db->update($this->table, $updateData, 'id='.$updateData->id);
        return $id;
    }

    public function deleteTests($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
        
    }

}

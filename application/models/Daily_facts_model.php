<?php

class Daily_facts_model extends CI_Model {
    
    public $table = 'daily_facts';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function quries()
    {
        $quries = array();
        $quries[] = "CREATE TABLE `innovator_bize`.`daily_facts` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `status` INT NOT NULL , `created_by` INT NOT NULL , `updated_by` INT NOT NULL , `created_time` VARCHAR(255) NOT NULL , `updated_time` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    }

    public function saveDailyFacts($saveData=null)
    {
        $save = new StdClass;
        $save->name = $saveData->name;
        $save->status = $saveData->status['code'];
        $id = $this->db->insert($this->table, $save);
        return $id;
    }

    public function updateDailyFacts($updateData=null)
    {
        $updateData->status = $updateData->status['code'];
        $id = $this->db->update($this->table, $updateData, 'id='.$updateData->id);
        return $id;
    }

    public function deleteDailyFacts($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
        
    }

}

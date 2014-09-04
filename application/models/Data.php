<?php
class Model_Data extends Zend_Db_Table_Abstract {
    
    private $db;
    
    public function init(){
        $this->db = $this->getAdapter();
    }
    
    public function getInstance(){
        return $this->db;
    }
}

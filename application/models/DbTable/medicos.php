<?php

class Model_DbTable_medicos extends Zend_Db_Table_Abstract{
    protected $_name ='medicos';
    private $db;
    
    public function init() {
        $this->db = $this->getAdapter();
    }    
    
    
    public function getMedicos(){        
        return $this->fetchAll();        
    }
    
}


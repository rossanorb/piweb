<?php

class Model_DbTable_consulta extends Zend_Db_Table_Abstract{
    protected $_name = 'consulta';    
    private $db;
    
    public function init(){
        $this->db = $this->getAdapter();
    }
    

    
}

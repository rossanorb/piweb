<?php

class Model_DbTable_uf extends Zend_Db_Table_Abstract{
    protected $_name = 'uf';
    
    public function init(){
        $this->db = $this->getAdapter();
    }    
    
    public function getUFs(){
        $ufs = new Model_DbTable_uf();
        return $ufs->fetchAll();       
        
    }
    
    
    
}
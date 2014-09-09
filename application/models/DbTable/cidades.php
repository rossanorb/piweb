<?php

class Model_DbTable_cidades extends Zend_Db_Table_Abstract{
    protected $_name = 'cidades';

    
     public function init() {
          $this->db = $this->getAdapter();
     }
         
    
    public function __construct($config = array()) {
        
    }

    
    
} 

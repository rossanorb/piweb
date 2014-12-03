<?php

class Model_agendamento extends Zend_Db_Table_Abstract{
    
    public function init(){
        $this->db = $this->getAdapter();
    }
    
    public function getAgendamento($id){
        if(filter_var($id, FILTER_VALIDATE_INT)){
            
        }
    }
    
    
}
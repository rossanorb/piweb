<?php

class Model_clinicasMedicos extends Zend_Db_Table_Abstract{
    protected $_name = 'clinicas_medicos';    
    private $db;
    
    public function init() {
        $this->db = $this->getAdapter();
    }
    
    public function vincularMedico($id_medico,$id_clinica){
        $this->insert(array('id_medico' => $id_medico, 'id_clinica' => $id_clinica, 'status' => 1 ));
    }
    
    public function atualizaStatus($id_medico,$id_clinica,$checked){
        $where = array(
            'id_medico = ?' => $id_medico,
            'id_clinica = ?' => $id_clinica
        );      
        
        $this->update(array('status'=> $checked ),$where );
    }
    
    public function exist($id_medico, $id_clinica){
       $arr = array(); 
       $row = $this->fetchRow(" id_clinica = {$id_clinica} and id_medico = {$id_medico}  ");       
       if(isset($row)){
           $arr = $row->toArray();
       }
       
       
       if(sizeof($arr) > 0 )
           return true;
       else
           return false;
       
    }
    
}
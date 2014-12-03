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
    
    
    public function authenticate($user, $senha){
        $session = new Zend_Session_Namespace('session');
        $sql = " select  id_medico as id_medico_autenticado from medicos where user = '{$user}' and senha = MD5('{$senha}') ";
        $stmt = $this->db->query($sql);
        $obj = $stmt->fetchObject();
        
        if(isset($obj->id_medico_autenticado)){
             $session->id_medico_autenticado = $obj->id_medico_autenticado;
                          
             return TRUE;
        }else{
            $session->id_medico_autenticado = NULL;
            
            return FALSE;
        }
        
        //$session->id_medico_autenticado = isset($obj->id_medico_autenticado)? $obj->id_medico_autenticado : NULL;       
        
    }
    

    
}


<?php

class Model_DbTable_consulta extends Zend_Db_Table_Abstract{
    protected $_name = 'consulta';    
    private $db;
    
    public function init(){
        $this->db = $this->getAdapter();
    }
    
    
    public function add($dados){
        $session = new Zend_Session_Namespace('session');        
        $id = $this->insert(array(
            'id_paciente' => $session->paciente_info['id_paciente'],
            'id_horarios' => $dados['id_horario'],
            'pago' => $dados['pago']
        ));
        
        return $id;
        
    }
    
    
}

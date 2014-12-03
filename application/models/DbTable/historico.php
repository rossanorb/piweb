<?php

class Model_DbTable_historico extends Zend_Db_Table_Abstract{
    protected $_name = 'historico';
    
    public function init(){
        $this->db = $this->getAdapter();
    }    
    
    public function add($post){
        $this->insert(array(
            'id_paciente' => $post['id_paciente'],
            'id_consulta' => $post['id_consulta'],
            'descricao' => $post['paciente_historico']
        ));
        
        
    }
    
    
    
}
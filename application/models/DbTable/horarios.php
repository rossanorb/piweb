<?php

class Model_DbTable_Horarios extends Zend_Db_Table_Abstract{
    protected $_name = 'Horarios';
    private $db;
    
    public function init() {
        $this->db = $this->getAdapter();
    }
    
    private function format($horario){        
        
            if(strlen($horario) == 3 ){
                $horario .= '0'.$horario;                
            }

            if(strlen($horario) == 4 ){                 
                $horario = substr($horario, 0,2).':'.substr($horario, 2,2);                 
            }
            
        return $horario;
    }
    
    private function hrAvailable($data){
        $sql = "SELECT data FROM horarios WHERE DATA = '$data' ";
        $stmt = $this->db->query($sql);
        $obj = $stmt->fetchObject();
        
        $ret = isset($obj->data)? $obj->data : "" ;
        
        return $ret;
    }
    
    public function add($dados){
        $session = new Zend_Session_Namespace('session');
        $id = [];
        
        foreach ($dados['dados']['horarios'] as $horario){
             
             if(is_numeric($horario)){
                    
                    $horario = $this->format($horario);
                    $data = $this->hrAvailable("{$dados['dados']['data']} $horario:00");
                    
                    if(empty($data)){                        
                        $id[] = $this->insert(array(
                                        'id_clinica' => $session->id_clinica,
                                        'id_medico' => $dados['dados']['id_medico'],
                                        'data' => "{$dados['dados']['data']} $horario:00",
                                        'valor' => '20.00',
                                        'horario' => $horario
                                       )
                                 );
                    }else{
                      //  print nl2br("id=> $session->id_clinica \n  id_medico => {$dados['dados']['id_medico']} \n data => $data  \n valor = '20.00' \n horario = $horario  \n \n \n ");
                    }
             }
            
        }

        if(sizeof($id)>0)
            return TRUE;
        else
            return FALSE;        
    }
    
}

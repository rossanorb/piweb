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
    
    private function hrAvailable($data,$id_medico){
        $session = new Zend_Session_Namespace('session');
        $sql = "SELECT data FROM horarios WHERE  id_clinica = {$session->id_clinica} and id_medico = $id_medico and DATA = '$data'";
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
                    $data = $this->hrAvailable("{$dados['dados']['data']} $horario:00", $dados['dados']['id_medico'] );
                    
                    if(empty($data)){                        
                        $id[] = $this->insert(array(
                                        'id_clinica' => 64,
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
    
    public function getListHorarios($id_medico){
        $session = new Zend_Session_Namespace('session');        
        $sql ="SELECT  id_horarios, id_clinica, id_medico, DATE(data) as fdata, valor, DATE_FORMAT(data,'%H:%i') as horario  FROM horarios WHERE  id_clinica = {$session->id_clinica} and id_medico = $id_medico ORDER BY data";
        $stmt = $this->db->query($sql);
        @$dados = $stmt->fetchAll();
        
       foreach ($dados as $value){          
           $d[$value['fdata']] [$value['id_horarios']][] = $value['horario'];
       }
       
       $retorno = isset($d)? $d : array();
       
        return $retorno;
    }
    
    public function getInforHorario($id_horario){
         if(filter_var($id_horario, FILTER_VALIDATE_INT)){
            $sql ="
                SELECT
                hr.id_horarios,
                m.nome,
                espc.especialidade,
                DATE_FORMAT(hr.data,'%d/%c/%Y') as fdata,
                DATE_FORMAT(hr.data,'%H:%i') as horario,
                cl.rua,
                cl.numero,
                cl.complemento,
                cl.bairro,
                cl.telefone,
                hr.valor

                FROM horarios hr JOIN medicos m ON ( hr.id_medico = m.id_medico)
                JOIN clinicas_medicos clm ON (hr.id_clinica = clm.id_clinica and m.id_medico = clm.id_medico)
                JOIN clinicas cl ON (clm.id_clinica = cl.id_clinica)
                JOIN especialidades espc ON ( m.id_especialidade = espc.id_especialidade)
                WHERE hr.id_horarios = {$id_horario} 
             ";
             
            $stmt = $this->db->query($sql);
            return $stmt->fetchObject();
         }
         return 0;
    }

    
    public function dl($id){
        if(filter_var($id, FILTER_VALIDATE_INT)){
            if($this->delete("id_horarios = $id "))            
                return true;
            else
                return false;            
        }        
        
    } 
    
}

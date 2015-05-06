<?php

class Model_DbTable_clinicas extends Zend_Db_Table_Abstract{
    protected $_name = 'clinicas';
    private $id = 0;
    private $db;
    
    public function init() {
        $this->db = $this->getAdapter();
    }    

    public function newClinica($formFields){
        $this->id = $this->insert(array(
            'ativo' => false,
            'logo' => NULL,
            'nome' => $formFields['nome'],
            'cnpj' => $formFields['cnpj'],
            'responsavel' => $formFields['responsavel'],
            'rua' => $formFields['rua'],
            'numero' => $formFields['numero'],
            'complemento' => $formFields['complemento'],
            'bairro' => $formFields['bairro'],
            'cep' => $formFields['cep'],
            'telefone' => $formFields['telefone'],
            'email' => $formFields['email'],
            'senha' => md5(102030)
        ));
        
                
        return $this->id;
    }
    
    public function updateLogo($filename, $id = 0){
        if($id > 0 ){
            $this->update(array('logo'=>$filename), "id_clinica =  $id ");
        }
    }

    private function getIdClinica($cnpj){
        $data =$this->fetchRow("cnpj like '$cnpj' ");
	return  $data['id_clinica'];
    }

    public function authenticate($formFields){
        $row = $this->fetchRow("cnpj Like '{$formFields['cnpj']}' ");
        if(sizeof($row)>0){            
            $clinica = $row->toArray();
        }else{            
            return false;
        }        
        
        if($clinica['ativo'] == NULL || $clinica['ativo'] == 0 ) return false;
        
        
        $auth = Zend_Auth::getInstance();        
        $authAdapter = new Zend_Auth_Adapter_DbTable( $this->db,'clinicas','cnpj','senha','MD5(?)');        
        $authAdapter->setIdentity($formFields['cnpj']);
        $authAdapter->setCredential($formFields['senha']);
        $result = $auth->authenticate($authAdapter);
        
        switch ($result->getCode()){
            case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:                
                return false;
                break;

            case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                return false;                
                break;

            case Zend_Auth_Result::SUCCESS:
                 $id_clinica = $this->getIdClinica($formFields['cnpj']);                 
                 $session = new Zend_Session_Namespace('session');                    
                 $session->id_clinica = $id_clinica;
                 $session->tipo = 'CLINICA';
                 return true;
                break;

            default : /** outros erros */
                return false;
                break;
        }
        
    }
    
    public function getListaInativos(){
        $sql = "SELECT * FROM clinicas WHERE ativo = 0 order by nome ";
        $query = $this->db->query($sql);
        $rows = $query->fetchAll();       
        return $rows;
    }
    
    public function getLista(){
       $sql = "SELECT * FROM clinicas order by nome";
       $query = $this->db->query($sql);
       $rows = $query->fetchAll();       
       return $rows;
    }
    
    public function Setstatus($st, $id_clinica){
         $this->update(array('ativo'=> ( $st=='true' ? 1:0 ) ), " id_clinica = $id_clinica ");
    }
   
}
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
            'senha' => md5(102030)
        ));
        
        $medicos = new Model_DbTable_medicos();
        $lista =  $medicos->getMedicos();
        
        // vincula todos os médicos cadastrados no sistema a nova clinica
        foreach ($lista as $medico){
            $sql = "Insert into clinicas_medicos (id_medico, id_clinica) VALUES ( {$medico['id_medico']}, {$this->id} ) ";
            $this->db->query($sql);
        }
                
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
                 return true;
                break;

            default : /** outros erros */
                return false;
                break;
        }
        
    }
   
    
}
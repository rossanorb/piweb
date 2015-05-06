<?php

class Model_DbTable_user extends Zend_Db_Table_Abstract{
    
    protected $_name = 'user';    
    private $db;
    
    public function init() {
        $this->db = $this->getAdapter();
    }        
    
    public function authenticate($formFields){
        $auth = Zend_Auth::getInstance();        
        $authAdapter = new Zend_Auth_Adapter_DbTable( $this->db,'user','email','password','MD5(?)');                
        $authAdapter->setIdentity($formFields['admin']);
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
                $session = new Zend_Session_Namespace('session');                   
                $session->login = $formFields['admin'];
                $session->tipo = 'ADM';
                 return true;
                break;

            default : /** outros erros */
                return false;
                break;
        }
        
        
    }
    
}
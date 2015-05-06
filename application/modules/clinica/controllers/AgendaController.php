<?php

class Clinica_AgendaController extends Zend_Controller_Action{
    
    public function init() {
       // parent::init();        
         $auth = Zend_Auth::getInstance();
         $session = new Zend_Session_Namespace('session');
         
         if(!$auth->hasIdentity() || $session->tipo != 'CLINICA' ) $this->_redirect ('site/clinica/login');         
    }        
    
    public function indexAction(){
        
        if($this->_getParam('id_consulta')){
            $consulta = new Model_DbTable_consulta();
            $consulta->setStatusAtendimento(1,$this->_getParam('id_consulta'));
        }

        $data = $this->_getParam('data') ? $this->_getParam('data') : date('d/m/Y');
        
        $horarios = new Model_DbTable_Horarios();
        $this->view->dados = $horarios->getHorarios($data);
        $this->view->data = substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4);
        
        
        
    }
}

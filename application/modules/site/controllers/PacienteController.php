<?php

class Site_PacienteController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();        
         $auth = Zend_Auth::getInstance();
         $session = new Zend_Session_Namespace('session'); 
         if(!$auth->hasIdentity() || !isset($session->paciente_info) ) $this->_redirect ('site/index/login');
         $this->_helper->layout->setLayout('paciente');
    }
    
    public function indexAction(){
        
        
        
        $consultas = new Model_DbTable_consulta();
        $this->view->dados = $consultas->getConsultas();
       
        
    }
    
    
}

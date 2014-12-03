<?php

class Clinica_AgendaController extends Zend_Controller_Action{
    
    public function init() {
       // parent::init();        
         $auth = Zend_Auth::getInstance();
         if(!$auth->hasIdentity()) $this->_redirect ('site/clinica/login');         
    }        
    
    public function indexAction(){     
        
        if($this->_getParam('id_consulta')){
            $consulta = new Model_DbTable_consulta();
            $consulta->setStatusAtendimento(1,$this->_getParam('id_consulta'));
        }
        
        $horarios = new Model_DbTable_Horarios();
        $this->view->dados = $horarios->getHorariosToday();
        
        
        
    }
}

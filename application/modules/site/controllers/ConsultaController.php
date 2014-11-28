<?php

class Site_ConsultaController extends Zend_Controller_Action{
    
    public function indexAction(){
        // $auth = Zend_Auth::getInstance();
         //if(!$auth->hasIdentity()) $this->_redirect ('site/clinica/login');        
         
        $auth = Zend_Auth::getInstance();
        if(!$auth->hasIdentity()){
            $this->view->logado = FALSE;
        }else{
            $this->view->logado = TRUE;
        }
        
        //$auth->hasIdentity ? ($this->view->logado = TRUE):$this->view->logado = FALSE;         
        
        $horarios = new Model_DbTable_Horarios();
                       
        $this->view->info = $horarios->getInforHorario($this->_getParam('id'));
                

        
        

        
    }
    
    

    
    
}

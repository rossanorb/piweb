<?php

class Clinica_AgendaController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();        
         $auth = Zend_Auth::getInstance();
         if(!$auth->hasIdentity()) $this->_redirect ('site/clinica/login');         
    }        
    
    public function indexAction(){
        
    }
}

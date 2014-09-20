<?php

class Site_PacienteController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();
         $auth = Zend_Auth::getInstance();
         if(!$auth->hasIdentity()) $this->_redirect ('site/index/login');
    }
    
    public function indexAction(){
        print 'você está logado';
        
    }
    
    
}

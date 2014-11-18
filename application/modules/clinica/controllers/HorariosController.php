<?php

class Clinica_HorariosController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();        
         $auth = Zend_Auth::getInstance();
         if(!$auth->hasIdentity()) $this->_redirect ('site/clinica/login');
    }    
    
    public function indexAction(){
        // lista médicos para edição
        $model = new Model_DbTable_medicos();
        $this->view->medicos = $model->getMedicos();
    }    
    
}
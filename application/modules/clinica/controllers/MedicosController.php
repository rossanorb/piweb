<?php

class Clinica_MedicosController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();        
         $auth = Zend_Auth::getInstance();
         if(!$auth->hasIdentity()) $this->_redirect ('site/clinica/login');         
    }    
    
    public function indexAction(){
        // lista médicos para edição
        $model = new Model_DbTable_medicos();
        $medicos = $model->getMedicos();
    }
    
    
}

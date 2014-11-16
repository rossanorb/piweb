<?php

class Clinica_MedicosController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();
    }
    
    public function indexAction(){
        // lista médicos para edição
        $model = new Model_DbTable_medicos();
        $medicos = $model->getMedicos();
    }
    
    
}

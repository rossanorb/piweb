<?php

class Clinica_IndexController extends Zend_Controller_Action{
    
    public function indexAction(){
       // $model =   new Teste_Class_Hello();
        //$this->_helper->layout->setLayout('site');
        $this->view->mensagem = ' Module: Clinica  / Controller: index / Action: index  ';        
         $user = new Application_Model_User();
         var_dump($user);
         
    }
    
    public function showAction(){
        $this->view->mensagem =  ' Module: Clínica  / Controller: index / Action: show  ';
    }
}
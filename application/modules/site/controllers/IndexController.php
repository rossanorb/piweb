<?php

class Site_IndexController extends Zend_Controller_Action{
    
    public function indexAction(){
       // $model =   new Teste_Class_Hello();
        //$this->_helper->layout->setLayout('site');
        $this->view->mensagem = ' Module: Site  / Controller: index / Action: index  ';
         //$user = new Application_Model_User();
         //var_dump($user);
         
        
         
    }
    
    public function showAction(){
        $this->view->mensagem =  ' Module: Site  / Controller: index / Action: show  ';
    }
}
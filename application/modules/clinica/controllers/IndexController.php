<?php

class Clinica_IndexController extends Zend_Controller_Action{
    
//    public function indexAction(){
//        $db = Zend_Db_Table::getDefaultAdapter();
//        $sql = 'Select * from posts';        
//        $query = $db->query($sql);
//        $rows = $query->fetchAll();        
//        
//        foreach ($rows as $row){
//            print '<p>Título: '.$row['title'] .'<p>';
//        }
//    }
//    
//    public function showAction(){
//        $this->view->mensagem =  ' Module: Clínica  / Controller: index / Action: show  ';
//    }
//    
//    public function formAction(){
//        $form = new Form_User();
//        var_dump($form);
//    }
    
    public function init() {        
        parent::init();        
         $auth = Zend_Auth::getInstance();
         if(!$auth->hasIdentity()) $this->_redirect ('site/clinica/login');
         
    }
    
    public function indexAction(){
        $this->view->mensagem = 'logado';        
    }
    
    public function logoutAction() {
            Zend_Auth::getInstance()->clearIdentity();
            $this->_redirect('clinica/index/');
    }
    
    
    
}
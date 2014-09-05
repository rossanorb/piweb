<?php

class Site_IndexController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();
    }
    
    public function testeAction(){
        //$db = Zend_Registry::getInstance()->get('db');              
        $db = Zend_Db_Table::getDefaultAdapter();        
        
        $sql = 'Select * from posts';        
        $query = $db->query($sql);
        $rows = $query->fetchAll();        
        
        foreach ($rows as $row){
            print '<p>Título: '.$row['title'] .'<p>';
        }     
        
    }
    
    public function indexAction(){
        $this->view->form = new Form_Busca();
        
    }
    
    public function buscaAction(){
        
    }
    
    public function cadastreseAction(){
        $this->view->form = new Form_Cliente();
    }
    
}
<?php

class Site_IndexController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();
    }
    
    public function testeAction(){

        
  
        
        //$db = Zend_Registry::getInstance()->get('db');              
//        $db = Zend_Db_Table::getDefaultAdapter();        
//        
//        $sql = 'Select * from posts';        
//        $query = $db->query($sql);
//        $rows = $query->fetchAll();        
//        
//        foreach ($rows as $row){
//            print '<p>Título: '.$row['title'] .'<p>';
//        }     
        
    }
    
    public function indexAction(){
        $this->view->form = new Form_Busca();
        
    }
    
    public function buscaAction(){
        
    }
    
    public function cadastreseAction(){
        
        if ($this->_request->isPost()) {
            $this->view->form = new Form_Cliente();            
            $formData = $this->_request->getPost();            
            $this->view->form->setIdUF($formData['uf']);                        
            $this->view->form->generate();            
            if ($this->view->form->isValid($formData)) { 
                print 'válido';
            } else {                
               $this->view->form->populate($formData);       
               print 'inválido';
            }
        }else{            
           $this->view->form = new Form_Cliente();
           $this->view->form->generate();
        }       
        
    }
    
    public function comboAction(){
        $this->_helper->layout->disableLayout();
        $name = $this->_request->getParam('name');
        $this->view->id = $this->_request->getParam('id');
        
        if($name){
            
            switch ($name){
                case 'uf' : 
                    $model = new Model_DbTable_cidades();
                    $this->view->combo = $model->getComboCidades($this->view->id);
                    $this->view->properties = 'cidade';
                break;


            }
        
        }
        

    }
    
    
    public function cadastroAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->view->render->setNoRender();
        
    }
    
    
}
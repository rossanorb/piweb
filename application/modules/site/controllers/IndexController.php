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
    
    private function insertCliente($formFields){
        $pacientes = new Model_DbTable_pacientes();                
        $id = $pacientes->insert(array(
                'nome' => $formFields['nome'],
                'rg' => $formFields['rg'],
                'cpf' => $formFields['cpf'],
                'dta_nasc' => substr($formFields['data'], 6, 4) .'-'. substr($formFields['data'], 3, 2).'-'. substr($formFields['data'], 0, 2),
                'estado_civil' => $formFields['estado_civil'],
                'sexo' => $formFields['sexo'],
                'telefone' => $formFields['telefone'],
                'rua' => $formFields['rua'],
                'numero' => $formFields['numero'],
                'complemento' => $formFields['complemento'],
                'bairro' => $formFields['bairro'],
                'id_cidade' => $formFields['cidade'],
                'cep' => $formFields['cep'],
                'email' => $formFields['email'],
                'senha' => md5($formFields['senha'])
        ));
        
        if( $id > 0 ) return true; else return false;
    }
    



    public function cadastreseAction(){
        
        if ($this->_request->isPost()) {
            $this->view->form = new Form_Cliente();            
            $formFields = $this->_request->getPost();
            if(isset($formFields['uf'])){
                $this->view->form->setIdUF($formFields['uf']);                        
            }
            $this->view->form->generate();
            
            if ($this->view->form->isValid($formFields)) {
                
                if($this->insertCliente($formFields)){ // se inseriu, tenta logar
                    
                    $pacientes = new Model_DbTable_pacientes();
                    if($pacientes->authenticate($formFields)){ // se logar redireciona para tela de consultas do paciente
                      $this->_redirect('site/paciente/'); // redireciona para tela do paciente   
                    }else{                      
                      $this->_redirect('site/index/login/auth/erro');
                    }
                    
                }else{
                    print 'ocorreu um erro ao cadastrar';
                    //$this->_redirect('site/index/login');
                }
                
            } else {
               $this->view->form->populate($formFields);   // formulário inválido
            }
            
        }else{
           $this->view->form = new Form_Cliente();
           $this->view->form->generate();
        }       
        
    }
    
    public function loginAction(){
        
        if( $this->_request->getParam('auth') == 'erro')
            $this->view->erro = ' - usuário ou senha inválidos';        
        
        if($this->_request->isPost()){
            $this->view->form = new Form_LoginCliente();
            $formFields = $this->_request->getPost();
            if($this->view->form->isValid($formFields)){
                
                    $pacientes = new Model_DbTable_pacientes();
                    
                    if($pacientes->authenticate($formFields)){ // se logar redireciona para tela de consultas do paciente
                        $this->_redirect('site/paciente/'); // redireciona para tela do paciente   
                    }else{
                       $this->_redirect('site/index/login/auth/erro');
                    }
                
            }
            
            $this->view->form->populate($formFields);
            
        }else{
            $this->view->form = new Form_LoginCliente();                         
        }
        
    }    
    
    public function cadastroAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->view->render->setNoRender();
        
    }       
    
    public function logoutAction() {
            Zend_Auth::getInstance()->clearIdentity();
            $this->_redirect('/');
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
    
    
}
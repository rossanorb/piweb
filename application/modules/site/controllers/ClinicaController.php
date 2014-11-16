<?php

class Site_ClinicaController extends Zend_Controller_Action{    

    public function cadastroAction(){
        if ($this->_request->isPost()) {  // se é post          
            $this->view->form = new Form_Clinica(); // instancia form 
            
            $formFields = $this->_request->getPost(); // pega campos dos formulário
            
            if(isset($formFields['uf'])){
                $this->view->form->setIdUF($formFields['uf']);                        
            }
            $this->view->form->generate();
                                    
            if($this->view->form->isValid($formFields)){ // verifica se formulário é válido               
                 $clinicas = new Model_DbTable_clinicas();
                 $id = $clinicas->newClinica($formFields);

                 if($id > 0 ){
                     //$filename = $this->fnum($formFields['cnpj']);  // remover barras 
                     
                     Model_Upload::sendfile($this->view->form->foto); // faz upload
                     if(Model_Upload::$adapter->getFileName()){
                         
                         $filename = $this->getName(Model_Upload::$adapter->getFileName());
                         
                        $clinicas->updateLogo($filename, $id); // seta o logo no banco
                     }
                    
                     
                 }else{
                     print 'não foi possível realizar o seu cadastro';
                 }

                
            }else{
                $this->view->form->populate($formFields); // form inválido, recupera campos preenchidos
            }
            
            
            
        }else{
            $this->view->form = new Form_Clinica();
            $this->view->form->generate();
        }
        
    }
    
    
    public function getName($path){
        $path = str_replace('\\', '/', $path);
        $arr = explode('/', $path);
        $filename = end($arr);
        return $filename;
    }
    
    public function loginAction(){
        
         $auth = Zend_Auth::getInstance();
         if($auth->hasIdentity()) $this->_redirect ('clinica/agenda');        
        
        $this->view->form = new Form_LoginClinica();
        
        if($this->_request->isPost()){
            $formFields = $this->_request->getPost();
            if($this->view->form->isValid($formFields)){
                 $clinicas = new Model_DbTable_clinicas();
                 if($clinicas->authenticate($formFields)){
                     $this->_redirect('/clinica/agenda/');
                 }else{
                     $this->_redirect('/site/clinica/login');
                 }
            }
            $this->view->form->populate($formFields);
        }else{
            
        }
        
    }    
        
    
    
}
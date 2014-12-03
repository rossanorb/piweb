<?php

class Clinica_AtendimentoController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();        
         $auth = Zend_Auth::getInstance();
         if(!$auth->hasIdentity()) $this->_redirect ('site/clinica/login');         
    }    
    
    public function indexAction(){
        $session = new Zend_Session_Namespace('session');
        if(isset($session->id_medico_autenticado)){
            $this->_redirect ('/clinica/atendimento/atendimento/'); 
        }
        
        
        
        
        
    }
    
    
    public function loginMedicoAction(){        
 	$this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();        
        $dados['status'] = false;
        
        
        $user = $this->_getParam('user');
        $senha = $this->_getParam('senha');
        
        $medico = new Model_DbTable_medicos();
        if($medico->authenticate($user, $senha)){
            $dados['status'] = true;
            // autenticado
            
        }else{
            $dados['status'] = false;
            $dados['error']   = "usuário ou senha inválidos";
        }
        
         echo Zend_Json::encode($dados);
    }
    
    
    public function atendimentoAction(){
        $session = new Zend_Session_Namespace('session');
        if(!isset($session->id_medico_autenticado)){
            $this->_redirect ('/clinica/atendimento/'); 
        }
            
        $consulta = new Model_DbTable_consulta();  
        $this->view->dado = $consulta->getAtendimento();

        
    }
    
    public function finalizarAction(){
        
        if ($this->_request->isPost()) { 
        
            $post = $this->_request->getPost();
            
            $consulta = new Model_DbTable_consulta();
            $consulta->setStatusAtendimento(2,$this->_getParam('id_consulta'));
            
            $historico = new Model_DbTable_historico();
            $historico->add($post);
        }
       
        
    }
    
    
}

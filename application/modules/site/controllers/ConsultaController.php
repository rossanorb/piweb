<?php

class Site_ConsultaController extends Zend_Controller_Action{
    
    public function indexAction(){
        // $auth = Zend_Auth::getInstance();
         //if(!$auth->hasIdentity()) $this->_redirect ('site/clinica/login');        
         
        $auth = Zend_Auth::getInstance();
        if(!$auth->hasIdentity()){
            $this->view->logado = FALSE;
        }else{
            $this->view->logado = TRUE;
        }
        
        //$auth->hasIdentity ? ($this->view->logado = TRUE):$this->view->logado = FALSE;         
        
        $horarios = new Model_DbTable_Horarios();
                       
        $this->view->info = $horarios->getInforHorario($this->_getParam('id'));
        
        
    }
    
       
    public function efetuaPagamentoAction(){
 	
        $this->_helper->layout->disableLayout();
        
        
        $dados = array();
        
        $dados['id_horario'] = $id_horario = $this->_getParam('id');       
        $nome = $this->_getParam('nome');
        $validade = $this->_getParam('validade');
        $numero = $this->_getParam('numero');
        
        // simula pagamento        
        if(empty($nome) || empty($validade) || empty($numero) ){
            $dados['pago'] = FALSE;
        }else{
            $dados['pago'] = TRUE;
        }
        
        
        
        
        $horarios = new Model_DbTable_Horarios();
        if($horarios->disponivel($id_horario)){
            $consulta = new Model_DbTable_consulta();
            $this->view->id = $consulta->add($dados);
        }else{
            $this->view->erro = $horarios->getStatus();
        }
        
        
        
    }
    
    

    
    
}

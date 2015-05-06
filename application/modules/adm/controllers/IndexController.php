<?php

class Adm_IndexController extends Zend_Controller_Action{
    
    public function init() {
        parent::init();
         $auth = Zend_Auth::getInstance();
         $session = new Zend_Session_Namespace('session');
         
         if(!$auth->hasIdentity() || $session->tipo != 'ADM'  ) $this->_redirect ('site/adm/login');         
    }     
    
    public function indexAction(){
        $model = new Model_DbTable_clinicas;
        $this->view->dados = $model->getLista();
    }
        
    public function desativadosAction(){
        //$this->_helper->viewRenderer('/index/index/', null, true);
        $model = new Model_DbTable_clinicas;
        $this->view->dados = $model->getListaInativos();

    }
        
    
    public function ativarAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $model = new Model_DbTable_clinicas();        
        $model->Setstatus($this->_getParam('set'), $this->_getParam('id') );
        $this->redirect('adm/');
        
    }

    public function logoutAction() {
            
        Zend_Auth::getInstance()->clearIdentity();
        $session = new Zend_Session_Namespace('session');
        $session->unsetAll();
        $this->_redirect('/site/adm/login');
    }
    
    public function cadastroMedicoAction(){
        $especialidades = new Model_DbTable_especialidades();
                                        
        if($this->_request->isPost()){
           $this->view->form = new Form_CadMedico();
           $formFields = $this->_request->getPost();

           if(isset($formFields['uf'])){
                $this->view->form->setIdUF($formFields['uf']);                        
           }        

           $this->view->form->generate();           

           if($this->view->form->isValid($formFields)){
              $medicos = new Model_DbTable_medicos();
              $this->view->id = $medicos->add($formFields);
           }else{
              $this->view->form->populate($formFields); // form inválido, recupera campos preenchidos
           }
            
        }else{
            $this->view->form = new Form_CadMedico();
            $this->view->form->generate();
        }
        
        
    }
    
    public function vincularMedicoAction(){
        //$this->_helper->viewRenderer->setNoRender();
        $medicos = new Model_DbTable_medicos();
        $this->view->lista_medicos = $medicos->getAllMedicos();
        $this->view->id = $this->_getParam('id');
        
        if(is_numeric($this->view->id)){
            $this->view->dados = $medicos->getListMedicosVinculados($this->view->id);
        }else{
            $this->view->dados = [];
        }        
        
    }
    
    public function vincularAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $id_medico =  $this->_getParam('id_medico');
        $id_clinica = $this->_getParam('id_clinica');
        $id_clinicas_medicos = $this->_getParam('id_clinicas_medicos');
        $checked = $this->_getParam('checked');
        
        $clm = new Model_clinicasMedicos();
        
        
        $existe =$clm->exist($id_medico,$id_clinica);
                
        if($existe === FALSE){
            $clm->vincularMedico($id_medico,$id_clinica);
             $dados['status'] = 'médico vinculado com sucesso!';
        }else{
            $clm->atualizaStatus($id_medico, $id_clinica, $checked);
            if($checked == 0){
                $dados['status'] = 'médico desativado com sucesso!';
            }else{
               $dados['status'] = 'médico ativado com sucesso!'; 
            }
        }
        echo Zend_Json::encode($dados);        
        
    }
    
    public function editarMedicoAction(){
        $medicos = new Model_DbTable_medicos();
        
        $this->view->lista_medicos = $medicos->getAllMedicos();
        $this->view->id = $this->_getParam('id');
        
        
        if($this->_request->isPost()){
            $this->view->form = new Form_CadMedico();
            $formFields = $this->_request->getPost();

            if(isset($formFields['uf'])){
                 $this->view->form->setIdUF($formFields['uf']);                        
            }        

            $this->view->form->generate();           
            $this->view->form->submit->setLabel('Atualizar');
            $this->view->form->setAction('/adm/index/editar-medico/')->setMethod('post'); //muda a action
            
            if($this->view->form->isValid($formFields)){
               $medicos = new Model_DbTable_medicos();
               $this->view->id = $medicos->edit($formFields);
               $this->redirect('/adm/index/editar-medico/id/'.$formFields['id_medico']);
            }else{
               $this->view->form->populate($formFields); // form inválido, recupera campos preenchidos
            }
        }else{
        
            if($this->view->id){
                $dados = $medicos->fetchRow(" id_medico = {$this->view->id} ")->toArray();        

                $data = substr($dados['dta_nasc'], 8, 2) . '/' . substr($dados['dta_nasc'], 5, 2) . '/' . substr($dados['dta_nasc'], 0, 4);

                $this->view->form = new Form_CadMedico();            
                $this->view->form->setIdUF($dados['id_uf']);
                $this->view->form->generate();
                $this->view->form->submit->setLabel('Alterar');
                $this->view->form->setAction('/adm/index/editar-medico/')->setMethod('post'); //muda a action

                $this->view->form->populate(array(
                    'id_medico' => $dados['id_medico'],
                    'nome' => $dados['nome'],
                    'crm' => $dados['crm'],
                    'data' => $data,
                    'telefone' => $dados['celular'],
                    'rua' => $dados['rua'],
                    'numero' =>  $dados['numero'],
                    'complemento' => $dados['complemento'],
                    'bairro' => $dados['bairro'],
                    'cep' => $dados['cep'],
                    'email' => $dados['email'],
                    'user' => $dados['user'],
                    'especialidade' => $dados['id_especialidade'],
                    'uf' => $dados['id_uf'],
                    'cidade' => $dados['id_cidade']
                ));
            }else{
                $this->view->form = new Form_CadMedico();
                $this->view->form->generate();
            }
        }
       
    }
    
}
<?php

class Clinica_HorariosController extends Zend_Controller_Action{
    
    public function init() {        
        parent::init();                              
        $auth = Zend_Auth::getInstance();
        $session = new Zend_Session_Namespace('session');
        if(!$auth->hasIdentity() || $session->tipo != 'CLINICA') $this->_redirect ('site/clinica/login');
    }    
    
    public function indexAction(){
        //$session = new Zend_Session_Namespace('session');
        //echo $session->id_clinica;        
        // lista médicos para edição
        $model = new Model_DbTable_medicos();
        $this->view->medicos = $model->getMedicos();
    }
    
    // retorna diferença de dias 2012-06-26 x 2012-06-28 = 2 
    public function compareDates($dateA, $dateB) {
            $dateB = new Zend_Date($dateB);
            $dateA = new Zend_Date($dateA);
            $diff = $dateB->sub($dateA)->toValue();
            $diffDays = ceil($diff / 60 / 60 / 24);
            return $diffDays;
    }

    private function validData($data){
        $diff = $this->compareDates($data, date("Y-m-d")); // menor x maior
        if($diff < 0){
            return true;
        }else{
            return false;
        }
    }
    
    private function validaHorarios($horarios){
        
    }
    
    public function addHorariosAction(){
 	$this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        $data = $this->_getParam('data');
        $hrs = $this->_getParam('horarios');
        $id_medico = $this->_getParam('id_medico');
        
        $dados['status'] = true;
        $dados['dados'] = array('data'=>$data, 'horarios'=>$hrs, 'id_medico'=>$id_medico);
         
         if(!$this->validData($data)){
             $dados['error']   = "a data não pode ser \n igual ou inferior a atual";
             $dados['status'] = false;
         }
         
         $horarios = new Model_DbTable_Horarios();
         $horarios->add($dados);
         
         $horarios = new Model_DbTable_Horarios();
         $this->view->dados = $horarios->getListHorarios($id_medico);         
         $view = $this->getHelper('ViewRenderer')->view;         
         $dados['html'] = $view->render('horarios/list-horarios.phtml');
         
         echo Zend_Json::encode($dados);
        
    }
    
    public function listHorariosAction(){
       $this->_helper->layout->disableLayout();
       $horarios = new Model_DbTable_Horarios();
       $this->view->dados = $horarios->getListHorarios($this->_getParam('id'));
    }
    
    public function dlAction(){
        $this->_helper->layout->disableLayout();        
        $horarios = new Model_DbTable_Horarios();
        $horarios->dl($this->_getParam('id'));
        $this->_helper->viewRenderer('horarios/list-horarios', null, true);         
        $horarios = new Model_DbTable_Horarios();
        $this->view->dados = $horarios->getListHorarios($this->_getParam('id_medico'));
       
    }
    
}
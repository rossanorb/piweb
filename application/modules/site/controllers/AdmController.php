<?php

class Site_AdmController extends Zend_Controller_Action{
    
    public function loginAction(){
        $this->view->form = new Form_LoginAdm();
        
        if($this->_request->isPost()){
            $formFields = $this->_request->getPost();

           if($this->view->form->isValid($formFields)){
                 $user = new Model_DbTable_user();
                 if($user->authenticate($formFields)){
                     $this->_redirect('/adm/');
                 }else{                     
                     $this->_redirect('/site/adm/login');
                 }
            }
            $this->view->form->populate($formFields);
           
        }
        
    }
}

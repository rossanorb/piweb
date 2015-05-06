<?php

class Form_LoginAdm extends Zend_Form{
    
    public function init() {
        $this->setName("logincln");
        
        //************* admin ***************************************
        $admin = new Zend_Form_Element_Text('admin');
        $admin->setLabel('Admin')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('stringLength',false, array(5,30));
        $this->addElement($admin);
        
        
        // ***** Senha *******************************************        
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('senha')                 
                ->setRequired(true)
                ->addFilters(array('StripTags','StringTrim' ))                
                ->addValidator('stringLength', true, array(6, 20))
                ->addErrorMessage('senha deve ter entre 6 e 20 caracteres')
                ;
        $this->addElement($senha);        

        $this->addElement('submit','submit',array('label'=>'Login'));
        $this->setAction('/site/adm/login')->setMethod('post');         
        
    }
    
}
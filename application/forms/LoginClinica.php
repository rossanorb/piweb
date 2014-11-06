<?php

class Form_LoginClinica extends Zend_Form{
    
    public function init() {
        $this->setName("logincln");
        
        //************* cnpj ***************************************
        $cnpj = new Zend_Form_Element_Text('cnpj');
        $cnpj->setLabel('CNPJ')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('stringLength',false, array(16,16));
        $this->addElement($cnpj);
        
        
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
        $this->setAction('/site/clinica/login')->setMethod('post');         
        
    }
    
}
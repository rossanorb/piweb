<?php
class Form_LoginCliente extends Zend_Form{
    
    public function init(){
        
        $this->setName('logincl');
       
        // ***** email *******************************************        
	$email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-email')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_EmailAddress())
                ->addErrorMessage('formato do email é inválido')
                ->addValidator('stringLength', false, array(0, 60));
        $this->addElement($email);
        
        
        // ***** Senha *******************************************        
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha')                 
                ->setRequired(true)
                ->addFilters(array('StripTags','StringTrim' ))                
                ->addValidator('stringLength', true, array(6, 20))
                ->addErrorMessage('senha deve ter entre 6 e 20 caracteres')
                ;
        $this->addElement($senha);
        
        
        $this->addElement('submit','submit',array('label'=>'Login'));
        $this->setAction('/site/index/login')->setMethod('post');        
    }
    
    
}
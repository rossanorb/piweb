<?php

class Form_Clinica extends Zend_Form{
    
    private $UfId = 0;

    public function __construct($options = null) {
        parent::__construct($options);        
    }
    
    public function setIdUF($UfId = 0){
        $this->UfId = $UfId;
    }
     
    
    public function generate() {
        
        $this->setName('clinica');        
       
        //************* nome ***************************************
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome clínica/médico')
                ->setRequired(true)
                ->addFilter('StringTrim')
                ->addValidators(array(
                    array('NotEmpty','breakChainOnFailure'=>true),                    
                    array('validator'=>'stringLength', 'options'=>array(2,200))
                    ));        
        $this->addElement($nome);
        
        //************* cnpj ***************************************
        $cnpj = new Zend_Form_Element_Text('cnpj');
        $cnpj->setLabel('CNPJ')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->addValidator('stringLength',false, array(16,16));
        $this->addElement($cnpj);
        
        //************* responsável ***************************************
        $responsavel = new Zend_Form_Element_Text('responsavel');
        $responsavel->setLabel('Nome do responsável')
                ->setRequired(true)
                ->addFilter('StringTrim')
                 ->addValidator('stringLength',false, array(2,200));
        $this->addElement($responsavel);
        
        // ******* rua ********************************************
        $this->addElement('text','rua', array(
            'label'=>'Rua',
            'required'=>true,
            'errorMessages'=>array('não informado')
        ));

        // *************  número ************************************
        $numero = new Zend_Form_Element_Text('numero');
        $numero->setLabel('Número')
                ->setRequired(true)
                ->addValidator('Digits')
                ->addErrorMessage('somente números');
        $this->addElement($numero);
        
        
        
        // ***** complemento *******************************************        
        $this->addElement('text','complemento', array(
            'label'=>'Complemento',
            'required'=>false
        ));

        
        // ***** bairro *******************************************        
        $this->addElement('text','bairro', array(
            'label'=>'Bairro',
            'required'=>true,
            'errorMessages'=>array('não informado')
        ));
        
        
        // ***** UF *******************************************                
        $options = array();
        $uf = new Model_DbTable_uf();
        $ufs = $uf->getUFs();        
        foreach($ufs as $row){            
            $options[$row['id_uf']] = $row['uf'];
        } 
        
        $select = new Zend_Form_Element_Select('uf');
        $select->setLabel('UF')
                ->addMultiOptions($options)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Regex('/[1-9]/'))
                ->addErrorMessage('não informado')
                ;                
        $this->addElement($select);
        
        
        
        // ***** cidade *******************************************
        $options = array();
        $cidades = new Model_DbTable_cidades();
        $options = $cidades->getComboCidades($this->UfId);
        
        $cidades = new Zend_Form_Element_Select('cidade');        
        $cidades->setLabel('Cidade');
        $cidades->addMultiOptions($options);
        $this->addElement($cidades);
        
        
        // ***** CEP *******************************************        
        $this->addElement('text','cep',array(
           'label' =>'CEP',
           'required'=>false
        ));
        
        // ************ Telefone *********************************
        $tel_contato = new Zend_Form_Element_Text('telefone');
        $tel_contato->setLabel('Telefone de Contato')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Regex( '/\([0-9]{2}\) [0-9]{4}-[0-9]{4}/'  ))
        	->addErrorMessage('formato inválido (DD) 0000-00000');
        $this->addElement($tel_contato);
        
        
        // ***** email *******************************************        
	$email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-email')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_EmailAddress())
                ->addErrorMessage('formato do email é inválido')
                ->addValidator('stringLength', false, array(0, 60));
        $this->addElement($email);        
   
        
        // ************ Foto *********************************
        $file = new Zend_Form_Element_File('foto');
        $file->setLabel('Escolha uma imagem:');
        // limite de tamanho
        $file->addValidator('NotEmpty');        
        $file->addValidator('Size', false, 1024000);
        // extensões: JPEG, PNG, GIFs
        $file->addValidator('Extension', false, 'jpg');        
        $file->addValidator('ImageSize', false, array(
                'minwidth' => 118,
                'maxwidth' => 118,
                'minheight' => 118,
                'maxheight' => 118,
        ));
        $this->addElement($file);
        
        
        $this->addElement('submit','submit',array('label'=>'Enviar'));
        $this->setAction('/site/clinica/cadastro')->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
    }
    
}

<?php

class Form_CadMedico extends Zend_Form{
    
    private $UfId = 0;

    public function __construct($options = null) {
        parent::__construct($options);        
    }
    
    public function setIdUF($UfId = 0){
        $this->UfId = $UfId;
    }
    
     public function generate(){
        
        $this->setName('cadmedic');
        
        //************* id_medico ***************************************
        $this->addElement('hidden','id_medico',array());
        
        //************* nome ***************************************
        $this->addElement('text', 'nome', array(
            'label'      => 'Nome Completo:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(10, 255))                
                ),
            'errorMessages'=>array('nome muito curto')
        ));    
        
        //************* crm ***************************************
        $this->addElement('text','crm',array(
            'label' => 'CRM',
            'required' => true
        ));
        
        //************* especialidades ***************************************
        $options = array();
        $especialidades = new Model_DbTable_especialidades();
        $rows = $especialidades->getEspecialidades();
        foreach($rows as $row){
            $options[$row['id_especialidade']] = $row['especialidade'];
        }
        
        $select = new Zend_Form_Element_Select('especialidade');
        $select->setLabel('especialidade')
                ->addMultiOptions($options)
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Regex('/[1-9]/'))
                ->addErrorMessage('não informado');                
        $this->addElement($select);
                
        // *************** data nasc *****************************
        $data = new Zend_Form_Element_Text('data');
        $data->setLabel('Data de Nascimento')
                ->setRequired(true)
                ->addFilter('StringTrim')
                ->addValidator('stringLength',true, array(10 , 10))
                ->addErrorMessage('Data inválida');
        $this->addElement($data);        
        
        // ************ Telefone *********************************
        $telefone = new Zend_Form_Element_Text('telefone');
        $telefone->setLabel('Telefone')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_Regex( '/\([0-9]{2}\) [0-9]{4}-[0-9]{4}/'  ))
        	->addErrorMessage('formato inválido (DD) 0000-00000');
        $this->addElement($telefone);
        
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
        
       
        // ***** email *******************************************        
	$email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-email')
                ->setRequired(true)
                ->addValidator(new Zend_Validate_EmailAddress())
                ->addErrorMessage('formato do email é inválido')
                ->addValidator('stringLength', false, array(0, 60));
        $this->addElement($email);
        
        
        // ***** login *******************************************        
        $this->addElement('text','user',array(
            'label' =>  'Usuário',
            'required'=>true
        ));
        
        $this->addElement('submit','submit',array('label'=>'Cadastrar'));
        $this->setAction('/adm/index/cadastro-medico')->setMethod('post');
        
       
    }
}


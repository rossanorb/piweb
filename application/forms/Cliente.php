<?php

class Form_Cliente extends Zend_Form{
    
    private $UfId = 7;

    public function __construct($options = null) {
        parent::__construct($options);        
    }
    
    public function setIdUF($UfId = 7){
        $this->UfId = $UfId;
    }
    
    
    public function generate() {
        
        $this->setName('cliente');
        
        //************* nome ***************************************
        $this->addElement('text', 'nome', array(
            'label'      => 'Nome Completo:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(10, 255))                
                ),
            'errorMessages'=>array('nome muito curto')
        ));        

        // ************* rg ***************************************
        $rg = new Zend_Form_Element_Text('rg');
        $rg->setLabel('RG');
        $rg->setRequired(true);
        $rg->addFilter('StringTrim');
        $rg->addValidator('stringLength', true, array(10, 10));
        $rg->addValidator('Digits');
        $rg->addErrorMessage('RG inválido');
        $this->addElement($rg);
       
        // ************* CPF *********************************
        $cpf = new Zend_Form_Element_Text('cpf');
        $cpf->setLabel('CPF')
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addValidator('stringLength',true, array(14 , 14))            
            ->addErrorMessage('CPF inválido');
        $this->addElement($cpf);
        
        
        // *************** data *****************************
        $data = new Zend_Form_Element_Text('data');
        $data->setLabel('Data de Nascimento')
                ->setRequired(true)
                ->addFilter('StringTrim')
                ->addValidator('stringLength',true, array(10 , 10))
                ->addErrorMessage('Data inválida');
        $this->addElement($data);
        
     
        // ************* Estado Civil *********************        
        $this->addElement('select','estado_civil',array(
            'label' => 'Estado Cívil',
            'required'=>false,
            'MultiOptions'=>array(''=>'Selecione...','c'=>'Casado','d'=>'Divorciado','s'=>'Solteiro','v'=>'Viúvo')
        ));
        
        // ********* sexo ************************************
        $this->addElement('select','sexo',array(
            'label' => 'Sexo',
            'required'=>true,
            'MultiOptions'=>array(''=>'Selecione...', 'm'=>'Masculino', 'f'=>'Feminino'),
            'errorMessages'=>array('campo sexo não selecionado')
        ));
        
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
        
        
        // ***** Senha *******************************************        
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha')                 
                ->setRequired(true)
                ->addFilters(array('StripTags','StringTrim' ))                
                ->addValidator('stringLength', true, array(6, 20))
                ->addErrorMessage('senha deve ter entre 6 e 20 caracteres')
                ;
        $this->addElement($senha);
        
        
        $this->addElement('submit','submit',array('label'=>'Enviar'));
        $this->setAction('/site/index/cadastrese')->setMethod('post');
        
    }
}
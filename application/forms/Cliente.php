<?php

class Form_Cliente extends Zend_Form{
    public function init() {
        
        $this->setName('cliente');
        
        // nome
        $this->addElement('text', 'nome', array(
            'label'      => 'Nome:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(10, 255))
                )
        ));
        
        $this->addElement('text','rg',array(
            'label' => 'RG',
            'required' => true
        ));
        
        
        $this->addElement('text','cpf',array(
            'label' => 'CPF',
            'required'=>true            
        ));
        
        $this->addElement('text','dta_nasc',array(
            'label'=>'Data De Nascimento',
            'required'=>true
        ));
        
        $this->addElement('select','estado_civil',array(
            'label' => 'Estado Cívil',
            'required'=>false,
            'MultiOptions'=>array('c'=>'Casado','d'=>'Divorciado','s'=>'Solteiro','v'=>'Viúvo')
        ));
        
        $this->addElement('select','sexo',array(
            'label' => 'Sexo',
            'required'=>true,
            'MultiOptions'=>array('m'=>'Masculino', 'f'=>'Feminino')
        ));
        
        $this->addElement('text','email', array(
            'label'=>'Email',
            'required'=>false
        ));
        
        $this->addElement('text','rua', array(
            'label'=>'Rua',
            'required'=>false
        ));
        
        $this->addElement('text','numero', array(
            'label'=>'Número',
            'required'=>false
        ));

        $this->addElement('text','complemento', array(
            'label'=>'Complemento',
            'required'=>false
        ));

        $this->addElement('text','bairro', array(
            'label'=>'Bairro',
            'required'=>false
        ));
        
        $options = array();
        
        $uf = new Model_DbTable_uf();
        $ufs = $uf->getUFs();        
        foreach($ufs as $row){
            $options[$row['id_uf']] = $row['uf'];
        }    
        
        
        $select = new Zend_Form_Element_Select('uf');
        $select->setLabel('UF');
        $select->addDecorators(array(
             'ViewHelper','Errors',array('HtmlTag', array('tag' => 'div','class'=>'uf'))
        ));        
        $select->addMultiOptions($options);
        $this->addElement($select);
        
        $this->addElement('select','cidade',array(
            'label'=>'cidade',
            'required'=>false,
            'MultiOptions'=>array()
        ));
        
        $this->addElement('text','cep',array(
           'label' =>'CEP',
           'required'=>false
        ));
        
        $this->addElement('password','senha',array(
           'label' =>'Crie uma Senha',
            'required'=>true
        ));
        
        
        $this->addElement('submit','submit',array(
            'label'=>'Enviar',
            'required'=>true
        ));
        
        
        
        $this->setAction('/')->setMethod('post');
        
    }
}
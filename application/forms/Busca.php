<?php

class Form_Busca extends Zend_Form{
    
    public function init() {    
        
        $options = array();
        $especialidades = new Model_DbTable_especialidades();        
        $rows = $especialidades->getEspecialidades();
        foreach($rows as $row){
            $options[$row['id_especialidade']] = $row['especialidade'];
        }    
        
        // select
        $select = new Zend_Form_Element_Select('especialidades');                
        $select->removeDecorator('Label');
        $select->addDecorators(array(
             'ViewHelper','Errors',array('HtmlTag', array('tag' => 'div','class'=>'dropdown'))
        ));        
        $select->addMultiOptions($options);
        
          
        
        // botão buscar
        $button = new Zend_Form_Element_button('button',array('disableLoadDefaultDecorators'=>true));
        $button->setLabel('buscar');
        
        $button->addDecorators(array(
            'ViewHelper',
            'Errors',            
            array('HtmlTag', array('tag' => 'div','id'=>'bt'))    
        ));
        
        
        $this->addElements(array($select,$button));
    }
    
}

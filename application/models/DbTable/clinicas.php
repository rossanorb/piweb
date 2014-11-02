<?php

class Model_DbTable_clinicas extends Zend_Db_Table_Abstract{
    protected $_name = 'clinicas';
    private $id = 0;


    public function newClinica($formFields){        
        $this->id = $this->insert(array(
            'ativo' => false,
            'logo' => NULL,
            'nome' => $formFields['nome'],
            'cnpj' => $formFields['cnpj'],
            'responsavel' => $formFields['responsavel'],
            'rua' => $formFields['rua'],
            'numero' => $formFields['numero'],
            'complemento' => $formFields['complemento'],
            'bairro' => $formFields['bairro'],
            'cep' => $formFields['cep'],
            'telefone' => $formFields['telefone']
        ));
        return $this->id;
    }
    
    public function updateLogo($filename, $id = 0){
        if($id > 0 ){
            $this->update(array('logo'=>$filename), "id_clinica =  $id ");
        }
    }    
    
}
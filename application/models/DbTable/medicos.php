<?php

class Model_DbTable_medicos extends Zend_Db_Table_Abstract {

    protected $_name = 'medicos';
    private $db;
    private $id_clinica;

    public function init() {
        $this->db = $this->getAdapter();
    }

    public function getAllMedicos(){
        return $this->fetchAll();        
    }
    
    public function getMedicos() {       
       $session = new Zend_Session_Namespace('session');
       $sql = " SELECT 
                        medicos.id_medico as id_medico,
                        medicos.nome as nome
                FROM medicos
                LEFT JOIN clinicas_medicos ON ( medicos.id_medico = clinicas_medicos.id_medico)
                LEFT JOIN clinicas ON ( clinicas.id_clinica = clinicas_medicos.id_clinica)
                WHERE clinicas.id_clinica = {$session->id_clinica}
                AND clinicas_medicos.status = 1 ";
        $stmt = $this->db->query($sql);
        $dados = $stmt->fetchAll();
        return $dados;        
        
    }

    public function authenticate($user, $senha) {
        $session = new Zend_Session_Namespace('session');
        $sql = " select  id_medico as id_medico_autenticado from medicos where user = '{$user}' and senha = MD5('{$senha}') ";
        $stmt = $this->db->query($sql);
        $obj = $stmt->fetchObject();

        if (isset($obj->id_medico_autenticado)) {
            $session->id_medico_autenticado = $obj->id_medico_autenticado;

            return TRUE;
        } else {
            $session->id_medico_autenticado = NULL;

            return FALSE;
        }

        //$session->id_medico_autenticado = isset($obj->id_medico_autenticado)? $obj->id_medico_autenticado : NULL;       
    }

    public function add($dados) {
        $data = substr($dados['data'], 6, 4) . '-' . substr($dados['data'], 3, 2) . '-' . substr($dados['data'], 0, 2);
        $id = $this->insert(array(
            'nome' => $dados['nome'],
            'crm' => $dados['crm'],
            'id_especialidade' => $dados['especialidade'],
            'dta_nasc' => $data,
            'celular' => $dados['telefone'],
            'cep' => $dados['cep'],
            'id_cidade' => $dados['cidade'],
            'id_uf' => $dados['uf'],
            'bairro' => $dados['bairro'],
            'complemento' => $dados['complemento'],
            'numero' => $dados['numero'],
            'rua' => $dados['rua'],
            'user' => $dados['user'],
            'senha' => md5(102030),
            'email' => $dados['email']
        ));
        return $id;
    }

    public function getListMedicosVinculados($id) {
        if (filter_var($id, FILTER_VALIDATE_INT)) {
            $sql = "SELECT
                CASE WHEN T.id_clinica IS NOT NULL THEN
                    TRUE
                ELSE
                    FALSE 
                END as has_clinica,
                T.status,
                T.id_clinicas_medicos,
                clinicas.nome as clinica_nome,
                clinicas.id_clinica as id_clinica
		FROM (
			SELECT * FROM clinicas_medicos 
			WHERE id_medico = {$id}
		)T RIGHT JOIN clinicas ON ( clinicas.id_clinica = T.id_clinica)";
            $stmt = $this->db->query($sql);
            $dados = $stmt->fetchAll();
            return $dados;
        }
    }
    
    public function edit($form){
        $dta_nasc = substr($form['data'], 8, 2) . '/' . substr($form['data'], 5, 2) . '/' . substr($form['data'], 0, 4);                
        $data = array(
                    'nome' => $form['nome'],
                    'crm' => $form['crm'],
                    'dta_nasc' => $dta_nasc,
                    'celular' => $form['telefone'],
                    'rua' => $form['rua'],
                    'numero' =>  $form['numero'],
                    'complemento' => $form['complemento'],
                    'bairro' => $form['bairro'],
                    'cep' => $form['cep'],
                    'email' => $form['email'],
                    'user' => $form['user'],
                    'id_especialidade' => $form['especialidade'],
                    'id_uf' => $form['uf'],
                    'id_cidade' => $form['cidade']
                );
        
       $this->update($data, " id_medico = {$form['id_medico']}");      
       
    }

}

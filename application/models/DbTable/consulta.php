<?php

class Model_DbTable_consulta extends Zend_Db_Table_Abstract{
    protected $_name = 'consulta';    
    private $db;
    
    public function init(){
        $this->db = $this->getAdapter();
    }
    
    
    public function add($dados){
        $session = new Zend_Session_Namespace('session');        
        $id = $this->insert(array(
            'id_paciente' => $session->paciente_info['id_paciente'],
            'id_horarios' => $dados['id_horario'],
            'pago' => $dados['pago']
        ));
        
        return $id;
        
    }
    
    public function getConsultas(){
        $session = new Zend_Session_Namespace('session');
        
        $sql = "SELECT 
                (SELECT hrs.data >= (select CURDATE())) as ativo,
                c.id_consulta as id_consulta,
                hrs.id_horarios as id_horarios,
                DATE_FORMAT(hrs.data,'%d/%c/%Y') as fdata,
                DATE_FORMAT(hrs.data,'%H:%i') as horario,                
                clm.id_clinica as id_clinica,
                sp.especialidade as especialidade,
                p.id_paciente as id_paciente,
                p.nome as nome,
                m.id_medico as id_medico,
                m.nome as medico,
                cl.nome as clinica,
                cl.rua,
                cl.numero,
                cl.complemento,
                cl.bairro,
                cl.telefone

                FROM pacientes p 
                LEFT JOIN consulta c ON ( p.id_paciente = c.id_paciente)
                join horarios hrs ON (hrs.id_horarios = c.id_horarios)
                join medicos m ON (m.id_medico = hrs.id_medico)
                join especialidades sp ON(m.id_especialidade = sp.id_especialidade)
                join clinicas_medicos clm ON ( clm.id_medico = m.id_medico AND clm.id_clinica = hrs.id_clinica )
                join clinicas cl ON ( cl.id_clinica = clm.id_clinica )
                WHERE p.id_paciente = {$session->paciente_info['id_paciente']}
                ORDER BY hrs.data desc ";               

            $query = $this->db->query($sql);
            $rows = $query->fetchAll();
            
            foreach ($rows as $row){
                
                $dados[$row['nome']][$row['id_horarios']]['fdata'] = $row['fdata'];
                $dados[$row['nome']][$row['id_horarios']]['horario'] = $row['horario'];
                $dados[$row['nome']][$row['id_horarios']]['medico'] = $row['medico'];
                $dados[$row['nome']][$row['id_horarios']]['especialidades'] = $row['especialidade'];
                $dados[$row['nome']][$row['id_horarios']]['clinica'] = $row['clinica'];
                $dados[$row['nome']][$row['id_horarios']]['rua'] = $row['rua'];
                $dados[$row['nome']][$row['id_horarios']]['numero'] = $row['numero'];
                $dados[$row['nome']][$row['id_horarios']]['complemento'] = $row['complemento'];
                $dados[$row['nome']][$row['id_horarios']]['bairro'] = $row['bairro'];
                $dados[$row['nome']][$row['id_horarios']]['telefone'] = $row['telefone'];
                $dados[$row['nome']][$row['id_horarios']]['ativo'] = $row['ativo'];
            }
            
            return @$dados;

    }
    
    public static function setStAtend($id_consulta){
        if(filter_var($id_consulta, FILTER_VALIDATE_INT)){
            $this->update(array('st_atend'=>1, " id_consulta = {$id_consulta} "));
        }
    }
    
    public function setStatusAtendimento($st,$id_consulta){
        $this->update(array('st_atend'=>$st), " id_consulta = $id_consulta ");
    }
    
    public function getAtendimento(){
        $session = new Zend_Session_Namespace('session');
        $sql = "SELECT 
                    p.id_paciente as id_paciente,
                    cs.id_consulta as id_consulta ,
                    hrs.id_horarios as id_horarios,
                    p.nome as nome, 
                    DATE_FORMAT(p.dta_nasc,'%d/%c/%Y') as dta_nasc          
                FROM medicos m 
                JOIN horarios hrs ON ( m.id_medico = hrs.id_medico)
                JOIN clinicas_medicos clm ON (m.id_medico = clm.id_medico)
                JOIN clinicas cl ON ( cl.id_clinica = clm.id_clinica)
                JOIN consulta cs ON ( hrs.id_horarios = cs.id_horarios)
                JOIN pacientes p ON ( p.id_paciente = cs.id_paciente)
                WHERE 
                m.id_medico = {$session->id_medico_autenticado} AND cl.id_clinica = {$session->id_clinica} AND cs.st_atend = 1 
                ORDER BY hrs.data  limit 1 ";
                
                
        $stmt = $this->db->query($sql);
        $obj = $stmt->fetchObject();
        
        return $obj;
        
    }
    
    
}

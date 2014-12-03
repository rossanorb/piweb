<?php
class Model_buscahorarios extends Zend_Db_Table_Abstract{
    
    public function init(){
        $this->db = $this->getAdapter();
    }
    
    public function getHorarios($id){
        if(filter_var($id, FILTER_VALIDATE_INT)){
            $sql = "
                    SELECT 
                        m.nome as nome,		
                        h.id_horarios as id_horarios,
                        h.id_clinica as id_clinica,
                        h.id_medico as id_medico,
                        h.valor as valor,
                        h.data,
                        DATE_FORMAT(h.data,'%d/%c/%Y') as fdata,
                        DATE_FORMAT(data,'%H:%i') as horario,
                        cs.id_consulta
                            
                    FROM especialidades esp 
                    join medicos m ON (esp.id_especialidade = m.id_especialidade)
                    join clinicas_medicos clm ON (clm.id_medico = m.id_medico)
                    join clinicas c ON ( clm.id_clinica = c.id_clinica)
                    join horarios h ON ( m.id_medico = h.id_medico)
                    LEFT JOIN consulta cs ON ( cs.id_horarios = h.id_horarios)
                    WHERE
                    esp.id_especialidade = {$id}  AND  h.data >= NOW() AND cs.id_consulta IS NULL
                    ORDER BY h.data";
            
            $stmt = $this->db->query($sql);
            $dados = $stmt->fetchAll();
            
            foreach ($dados as $value){
                $lista[$value['fdata']][$value['nome']][$value['id_horarios']] = $value['horario'];
            }
            
            $retorno = isset($lista)? $lista : array();

            return $retorno;
        }
    }
    
    
    
}


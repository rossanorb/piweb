<?php
class Model_DbTable_especialidades extends Zend_Db_Table_Abstract {
     protected $_name = 'especialidades';
     
     public function init() {
          $this->db = $this->getAdapter();
     }
     
     public function getEspecialidades(){
         $sql = "Select id_especialidade, especialidade FROM especialidades ";
         $query = $this->db->query($sql);
         $rows = $query->fetchAll();
         return $rows;         
     }
    
}

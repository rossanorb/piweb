<?php

class Model_DbTable_cidades extends Zend_Db_Table_Abstract{
    protected $_name = 'cidades';

    
     public function init() {
        $this->db = $this->getAdapter();
     }
         

    public function getComboCidades($id){
        $cidades = array();
        
        if($id){
            $sql = "SELECT cidades.id_cidade as id, cidades.cidade as name FROM cidades join uf ON(cidades.id_uf = uf.id_uf)
                    WHERE uf.id_uf = {$id} order by  cidades.cidade ASC  ";
            $query = $this->db->query($sql);
            $rows = $query->fetchAll();
            
            foreach ($rows as $row){
                $cidades[$row['id']] = $row['name'];
            }        
           
        }        
        
        return $cidades;
        
    }
    
} 

<?php

class Model_Upload{
       
    public static $adapter;
    
    public static function sendfile($foto){



        self::$adapter = $foto->getTransferAdapter();
        self::$adapter->setDestination(UPLOAD);


        try{
            self::$adapter->receive();     
        } catch (Zend_File_Transfer_Exception $e) {
            $e->getMessage();             
        } 


        //$filterFileRename = new Zend_Filter_File_Rename(array('target' => UPLOAD.$filename.'.jpg', 'overwrite' => true ));
        //$filterFileRename->filter(self::$adapter->getFileName());        
        
        
    }
    
    
    
    
}
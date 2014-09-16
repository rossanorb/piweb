<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{
    
//        protected function _initDefaultModuleAutoloader(){ 
//
//            $resourceLoader = new Zend_Application_Module_Autoloader(array(
//                'namespace' => '',
//                'basePath'  => APPLICATION_PATH,
//            ));
//
//            return $resourceLoader;
//
//        }
    
        protected function _initResourceAutoloader()
        {
             $autoloader = new Zend_Loader_Autoloader_Resource(array(
                'basePath'  => APPLICATION_PATH,
                'namespace' => '',
             ));

             $autoloader->addResourceType( 'model', 'models/', 'Model')                        
                        ->addResourceType('form', 'forms/', 'Form');
             return $autoloader;
        }    
        
//        protected function _initDbRegister(){           
//           $db = $this->bootstrap('Db')->getResource('Db');
//           Zend_Registry::getInstance()->set('db', $db); 
//        }        
    
}


<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {        
        //resources.frontController.controllerDirectory = APPLICATION_PATH "/controllers"
       // Zend_Controller_Front::getInstance()        
       //     ->setParam('useDefaultControllerAlways', true);        // irá redirecionar sempre para o controlador padrão
    }   
    
    
}


<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {        
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
        
       // Zend_Controller_Front::getInstance()        
       //     ->setParam('useDefaultControllerAlways', true);        // irá redirecionar sempre para o controlador padrão
    }   

}


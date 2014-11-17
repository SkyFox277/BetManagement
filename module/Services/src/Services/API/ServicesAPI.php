<?php
/**
 * @author JF
 * SOAP API
 */
 
namespace Services\API;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Services\Model\GroupTable;
use Services\Controller\ReturnableClass;
use Zend\Db\Adapter\Adapter;
use Zend\Di\Definition\ClassDefinition;

class ServicesAPI
{

    public function __construct()
    {

    }
    
    /**
     * This method takes a value and gives back the md5 hash of the value
     *
     * @param String $value
     * @return String
     */
    public function md5Value($value) {
        return md5($value);
    }
    
    /**
     * Hello World
     * @return string
     */
    public function hello(){
        return 'Halli hallo halloly';
    }
    
    /**
     * Serverauthentification.
     * @return string
     */
    public function SignIn(){
    	return 'nothing';
    }
}
<?php
/**
 * @author JF
 * SOAP API
 */
 
namespace Services\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Services\Model\GroupTable;
use Services\Controller\ReturnableClass;

class servicesAPI
{
    /**
     * @var int
     * */
    public $id;
    
    /**
     * @var string
     * */
    public $firstname;
    
    /**
     * @var string
     * */
    public $lastname;
    
    /**
     ***tio @var \ViewModels\DiagnosisViewModel[]**
     * */
    public $diagnosis;
    

    
    public function __construct()
    {
        $this->id = 1;
        $this->firstname = 'asd';
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
        return 'Hello Martin';
    }
    
    /**
     * Serverauthentification.
     * @return string
     */
    public function SignIn(){
    	return 'nothing';
    }
}
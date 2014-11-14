<?php
/**
 * @author JF
 * SOAP API
 */
 
namespace Services\Controller\API;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Services\Model\GroupTable;

class servicesAPI extends AbstractActionController
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
    
    protected $groupTable;
    
    public function getGroupTable()
    {
        if (!$this->groupTable) {
            $sm = $this->getServiceLocator();
            $this->groupTable = $sm->get('Services\Model\GroupTable');
        }
        return $this->groupTable;
    }
    
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
    public function hello()
    {
        return 'Hello Martin';
    }
    
    

}
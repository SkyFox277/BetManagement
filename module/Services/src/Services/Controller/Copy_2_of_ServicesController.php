<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Services for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Services\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Zend\Http\Client;

require_once 'API/Soaptest.php';


class ServicesController extends AbstractActionController
{
 //change this to your WSDL URI!
   private $_WSDL_URI="http://betmanagement.localhost/services?wsdl";
   private $_URI="http://betmanagement.localhost/services?wsdl";

    public function indexAction()
    {    
        
            
        if(isset($_GET['wsdl'])) {
            //return the WSDL
            $this->hadleWSDL();
        } else {
            //handle SOAP request
            $this->handleSOAP();
        }
    }

    private function hadleWSDL() {
        $autodiscover = new AutoDiscover();
        $autodiscover->setClass('Soaptest')
                    ->setBindingStyle(array('style' => 'document'))
                    ->setUri($this->_URI . $_SERVER['SCRIPT_NAME']);
         header('Content-type: application/xml');
        $wsdl = $autodiscover->generate();
//         $wsdl->dump("/home/i/Documents/web/Betmanagement/public/bm.wsdl");
//         echo $autodiscover->toXml();
        $autodiscover->handle();
    }
    
    private function handleSOAP() {
        $soap = new Server(null,$this->_WSDL_URI); 
        $soap->setClass('Soaptest');
        $soap->handle();
    }
    
    public function clientAction() {
        $client = new Client($this->_WSDL_URI);
        
        $this->view->add_result = $client->math_add(11, 55);
        $this->view->not_result = $client->logical_not(true);
        $this->view->sort_result = $client->simple_sort(
       array("d" => "lemon", "a" => "orange",
             "b" => "banana", "c" => "apple"));
        
    }
    public function testAction() {
        return array();
    
    }
}

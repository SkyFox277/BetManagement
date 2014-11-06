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

ini_set("soap.wsdl_cache_enabled", 0);

require_once 'API/servicesAPI.php';


class ServicesController extends AbstractActionController
{
 //change this to your WSDL URI!
    private $_WSDL_URI="http://betmanagement.localhost/services?wsdl";
    private $_URI="http://betmanagement.localhost/services";

    public function indexAction()
    {
        if(isset($_GET['wsdl'])) {
                       
            $autodiscover = new AutoDiscover();
            $autodiscover->setClass('Services\Controller\servicesAPI');

            $autodiscover->handle();

        } else {

            $soap = new \SoapServer($this->_WSDL_URI);
            $soap->setClass('Services\Controller\servicesAPI');
            $soap->handle();
        }
    } 


    public function wsdlAction()
    {
       
        $autodiscover = new AutoDiscover();
            $autodiscover->setClass('servicesAPI');

            $autodiscover->handle();
// //         header ("Content-Type:text/xml");
//         header('Content-type: application/xml');
//         $wsdl = $autodiscover->generate()->toXML();
//         echo $wsdl;
//         exit();
// $autodiscover->handle();
    
    }


    public function clientAction() {
        
        $client = new \Zend\Soap\Client($this->_WSDL_URI);
        
        $client->getFunctions();
//          $client->hello();
    }
}

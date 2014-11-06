<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Services for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Services\Controller;

ini_set("soap.wsdl_cache_enabled", 0);

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Services\Controller\API;


class ServicesController extends AbstractActionController
{
    private $_options;
    private $_URI = "http://betmanagement.local/services";
    private $_WSDL_URI = "http://betmanagement.local/services";
 
    
    public function indexAction() {
        if (isset($_GET['wsdl'])) {
            $this->handleWSDL();
        } else {
            $this->handleSOAP();
        }
        return $this->getResponse();
    }

    private function handleWSDL() {

        $autodiscover = new AutoDiscover();
        $autodiscover->setClass('servicesAPI')
                    ->setBindingStyle(array('style' => 'document'))
                    ->setUri($this->_URI . $_SERVER['SCRIPT_NAME']);
         header('Content-type: application/xml');
        $wsdl = $autodiscover->generate();
//         $wsdl->dump("/home/i/Documents/web/Betmanagement/public/bm.wsdl");
//         echo $autodiscover->toXml();
        $autodiscover->handle();
    }

    private function handleSOAP() {

//         $soap = new Server(null,['wsdl' => $this->_WSDL_URI]);
        $soap = new Server([$this->_WSDL_URI . $_SERVER['SCRIPT_NAME'] . '?wsdl']);
        $soap->setClass('servicesAPI');
        $soap->setObject(new API\SoapExceptionHandler(new API\servicesAPI()));
        $soap->handle();
    }
}

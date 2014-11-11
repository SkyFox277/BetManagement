<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\Client;

class IndexController extends AbstractActionController
{
    //TODO: Variablen auslagern
    private $_WSDL_URI="http://localhost/services?wsdl";
    private $_URI="http://localhost/services";
    
    public function indexAction()
    {
     $client = new Client($this->_WSDL_URI);
        
        echo  $client->hello();
        echo $client->md5Value("qwea");


//         print_r($client->getClassmap());
//         echo "</br></br>--------</br>";
//         print_r($client->getLastMethod());
//         echo "</br></br>--------</br>";
//         print_r($client->getLastRequestHeaders());
//         echo "</br></br>--------</br>";
        //         print_r($client->getLastRequest());
        //         echo "</br></br>--------</br>";
        //         print_r($client->getLastResponseHeaders());
        //         echo "</br></br>--------</br>";
//         print_r($client->getLastResponse());
//         echo "</br></br>--------</br>";
//         print_r($client->getOptions());
//         echo "</br></br>--------</br>";
//         print_r($client->getWSDL());
//         echo "</br></br>--------</br>";
        
        //                 try {
        //                     $responce = $client->hello();
        //                     echo $responce;
        //                     if ($responce == \SoapFault){
        //                         echo $client->getLastResponse();
        //                     }
        //                 } catch (\Exception $e) {
        
        //                 }
    }
}

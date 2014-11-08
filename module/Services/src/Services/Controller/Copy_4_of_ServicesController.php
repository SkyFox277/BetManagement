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
use Zend\Soap\Client;

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
                      
            $api = new servicesAPI();
                        
            $autodiscover = new AutoDiscover();
            $autodiscover   ->setClass($api)
//                             ->setBindingStyle(array('style' => 'Document/Literal',
//                                                     'use' => 'literal'
                                
//                                                    )
//                                               )
                            ->setUri($this->_URI)
                            
            ;
//             header ("Content-Type:text/xml");
// //             header('Content-type: application/xml');
//             $wsdl = $autodiscover->generate();
            $autodiscover->handle();
//             echo $wsdl->toXml();
//             $wsdl->dump("/tmp/bm.wsdl");
//             $dom = $wsdl->toDomDocument();
        } else {
   
            $api = new servicesAPI();
        
            $soap = new Server($this->_WSDL_URI);
            $soap->setClass($api);
            $soap->handle();
        }
        return $this->getResponse();
    } 


    public function wsdlAction()
    {
       
        $api = new servicesAPI();
                        
        $autodiscover = new AutoDiscover();
        $autodiscover   ->setServiceName('servicesAPI')
        ->setBindingStyle(array('style' => 'Document/Literal'))
                        ->addFunction('hello')
                        ->setUri($this->_URI);

        $wsdl = $autodiscover->generate()->toXML();
        echo $wsdl;
        exit();
// $autodiscover->handle();
    
    }


    public function clientAction() {
        
//         $testSS = "http://localhost/BasicSoap/index.php";
        
//         $wsdlOptions = array('soap_version' => SOAP_1_1,
//                             'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | 5,
//                             'location' => $testSS,
//                             'uri'      => $testSS,
//                             "style"    => SOAP_RPC,
//                             "use"      => SOAP_ENCODED
//                     );
        
//         $client = new \SoapClient(null, $wsdlOptions);
// //         $client->setOptions($wsdlOptions);
        
//         echo $client->hello() . "</br>";
//         echo $client->helloNachricht("Hallo server");
        
        ////------ZF2 Server
        
        $wsdlOptions = array('soap_version' => SOAP_1_2,
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | 5,
            'location' => $this->_URI,
            'uri'      => $this->_URI,
            'encoding' => 'UTF-8',
        );
        
        $client = new Client($this->_WSDL_URI);
//         $client = new \SoapClient(null, $wsdlOptions);


//         echo "</br></br>__getTypes--------</br>";
//         print_r($client->__getTypes());
//         echo "</br></br>__call--------</br>";
// //         print_r($client->__call("hello", []));

//                 try {
//                     $responce = $client->hello();
//                     echo $responce;
//                     if ($responce == \SoapFault){
//                         echo $client->getLastResponse();
//                     }
//                 } catch (\Exception $e) {

//                 }
        
        
//         echo "</br></br>__getLastRequest--------</br>";
//         print_r($client->getLastRequest());
//         echo "</br></br>__getLastResponse--------</br>";
//         print_r($client->getLastResponse());
//         echo "</br></br>__getFunctions--------</br>";
//         print_r($client->getFunctions());
//         echo "</br></br>--------</br>";

//         print_r($client->getClassmap());
//         echo "</br></br>--------</br>";
//         print_r($client->getLastMethod());
//         echo "</br></br>--------</br>";
//         print_r($client->getLastRequestHeaders());
//         echo "</br></br>--------</br>";
//         print_r($client->getLastResponseHeaders());
//         echo "</br></br>--------</br>";
//         print_r($client->getOptions());
//         echo "</br></br>--------</br>";
//         print_r($client->getWSDL());
//         echo "</br></br>--------</br>";
        
        echo  $client->hello();
        echo $client->md5Value("qwe");

//         try {
//             $responce = $client->hello();
//             if ($responce == \SoapFault){
//                 echo $client->getLastResponse();
//             }
//         } catch (Exception $e) {
//             echo $client->getLastResponse(); 
//         }
        
        //$this->_helper->viewRenderer->setNeverRender();
    }
}


//             $ctx = stream_context_create();

//             $typeMap = array(
//                 array(
//                     'type_name' => 'dateTime',
//                     'type_ns' => 'http://www.w3.org/2001/XMLSchema',
//                     'from_xml' => 'strtotime',
//                     'to_xml' => 'strtotime',
//                 ),
//                 array(
//                     'type_name' => 'date',
//                     'type_ns' => 'http://www.w3.org/2001/XMLSchema',
//                     'from_xml' => 'strtotime',
//                     'to_xml' => 'strtotime',
//                 )
//             );

//             $nonWSDLOptions = array('soap_version' => SOAP_1_1,
//                 'classmap' => array('TestData1' => '\ZendTest\Soap\TestAsset\TestData1',
//                     'TestData2' => '\ZendTest\Soap\TestAsset\TestData2',),
//                 'encoding' => 'ISO-8859-1',
//                 'uri' => 'http://framework.zend.com/Zend_Soap_ServerTest.php',
//                 'location' => 'http://framework.zend.com/Zend_Soap_ServerTest.php',
//                 'use' => SOAP_ENCODED,
//                 'style' => SOAP_RPC,
//                 'login' => 'http_login',
//                 'password' => 'http_password',
//                 'proxy_host' => 'proxy.somehost.com',
//                 'proxy_port' => 8080,
//                 'proxy_login' => 'proxy_login',
//                 'proxy_password' => 'proxy_password',
//                 'local_cert' => __DIR__.'/TestAsset/cert_file',
//                 'passphrase' => 'some pass phrase',
//                 'stream_context' => $ctx,
//                 'cache_wsdl' => 8,
//                 'features' => 4,
//                 'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | 5,
//                 'typemap' => $typeMap
//             );

//             $this->assertTrue($client1->getOptions() == array('encoding' => 'UTF-8', 'soap_version' => SOAP_1_2));
//             $wsdlOptions = array('soap_version' => SOAP_1_1,
//                 'wsdl' => __DIR__.'/TestAsset/wsdl_example.wsdl',
//                 'classmap' => array('TestData1' => '\ZendTest\Soap\TestAsset\TestData1',
//                     'TestData2' => '\ZendTest\Soap\TestAsset\TestData2',),
//                 'encoding' => 'ISO-8859-1',
//                 'login' => 'http_login',
//                 'password' => 'http_password',
//                 'proxy_host' => 'proxy.somehost.com',
//                 'proxy_port' => 8080,
//                 'proxy_login' => 'proxy_login',
//                 'proxy_password' => 'proxy_password',
//                 'local_cert' => __DIR__.'/TestAsset/cert_file',
//                 'passphrase' => 'some pass phrase',
//                 'stream_context' => $ctx,
//                 'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | 5,
//                 'typemap' => $typeMap
//             );



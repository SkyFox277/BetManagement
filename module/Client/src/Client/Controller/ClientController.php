<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Client for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Client\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\Client;
use Zend\View\Model\ViewModel;
use Services\Model\Group;


class ClientController extends AbstractActionController
{  
    /**
     * Einstiegsfunktion des Soap-Clients. (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $sconfig = $this->getServiceLocator()->get('Config')['ServerConfig'];
        $options = array('compression' => SOAP_COMPRESSION_ACCEPT,'cache_wsdl' => 0,'soap_version'   => SOAP_1_2);
        
        echo "client </br>";
     	$client = new Client($sconfig['wsdl'], $options);

     	echo $client->hello();
        echo "<br>" . $client->md5Value("qwea");
               
        echo "<br>" .$client->signin();
        
        echo "<br>" . $result = $client->getGroupTable();
        
        
        echo "<br>----------------------";
        echo "<br>";
        echo $client->getLastRequest();
        echo "<br>----------------------";
        echo "<br>"; 
        echo $client->getLastResponse();
        echo "<br>----------------------";
        
        echo "<pre>";
        var_dump($result);
        echo "</pre>";
//         return $this->response;

        
        $data = array('id'          => 4,
            'voicetag'      => 'DE',
            'groupname'     => 'test1',
            'isactive'      => 1
        );
        
        $group = new Group($data);
        echo "<pre>";
        var_dump($group);
        echo "</pre>";

        return new ViewModel();
    }
    
    
    public function test1Action()
    {
        echo "test1 </br>";
               
        return new ViewModel();
    }
    
    
    public function test2Action()
    {
        echo "test2 </br>";
         
        return new ViewModel();
    }
    
    
    public function test3Action()
    {
        echo "test3 </br>";
         
        return new ViewModel();
    }
}

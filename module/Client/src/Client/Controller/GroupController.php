<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Client\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\Client;
use Zend\View\Model\ViewModel;

class GroupController extends AbstractActionController
{
    
    public function indexAction()
    {
        echo "index </br>";
     $client = new Client($this->_WSDL_URI);
        
        echo  $client->hello();
        echo $client->md5Value("qwea");

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

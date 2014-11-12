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


class StartController extends AbstractActionController
{
    public function indexAction()
    {
        $client = new \SoapClient("http://betmanagement.local/services?wsdl");

        

        echo $client->hello();
        
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /start/start/foo
        return array();
    }
}

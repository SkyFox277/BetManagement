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
use Services\API\ServicesAPI;

// TODO nach dem testen auskomentieren
use Zend\View\Model\ViewModel;


class ServicesController extends AbstractActionController
{
	private $sconfig;

	public function wsdlAction()
	{
	    ini_set("soap.wsdl_cache_enabled", "0");
	    
	    $this->sconfig = $this->getServiceLocator()->get('Config')['ServerConfig'];
	    
		$api = new ServicesAPI();
// 		$api = new ServicesAPI($this->getServiceLocator()->get('db'));

		$autodiscover = new AutoDiscover();
		$autodiscover   ->setClass($api)
		->setUri($this->sconfig['uri'])
		;
		$autodiscover->handle();

		return $this->getResponse();
	}

	public function indexAction()
	{
	    $this->sconfig = $this->getServiceLocator()->get('Config')['ServerConfig'];
		$api = new ServicesAPI();
// 		$api = new ServicesAPI($this->getServiceLocator()->get('db'));
		
		ini_set("soap.wsdl_cache_enabled", "0");

		if(isset($_GET['wsdl'])) {
		    
			$autodiscover = new AutoDiscover();
			$autodiscover   ->setClass($api)
			->setUri($this->sconfig['uri']);
			$autodiscover->handle();

		} else {

		    $options=array('cache_wsdl' => 0);
		    
		    //TODO eventuell später die Adresse anpassen
// 		    $basePath = $this->getRequest()->getBasePath();
// 		    ->setUri('http://'.$_SERVER['SERVER_NAME'].$basePath.'/soapserver/soap')
		    
			$soap = new Server($this->sconfig['wsdl'], $options);
			$soap->setClass($api);
			$soap->handle();

			//return new ViewModel(array(
			//		'groupen' => $this->getGroupTable()->fetchAll(),
			//));
	
		}
		return $this->getResponse();
	}
}
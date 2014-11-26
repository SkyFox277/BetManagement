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
use Services\Model\Group;
use Services\Model\GroupTable;

// TODO nach dem testen auskomentieren
use Zend\View\Model\ViewModel;



use Zend\Soap\Wsdl\ComplexTypeStrategy\ArrayOfTypeComplex;
use Zend\Soap\Wsdl\ComplexTypeStrategy\AnyType;


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
		
		$classmap = array('Group'         => 'Group',
		                  'ServicesAPI'   => 'ServicesAPI'
			);
		
		$types = new \Zend\Soap\Wsdl\ComplexTypeStrategy\AnyType();
		$types->addComplexType('Group');

		if(isset($_GET['wsdl'])) {
		    
			//Logindaten pr�fen.
			//$Auth = new \Authentification('adm','pwd');
			//$Auth = new \Authentification('adm', 'pwd');	
			
			//if (isset($options['login']) && isset($options['password']))
			//{
				$autodiscover = new AutoDiscover();
				$autodiscover->setServiceName('BMService')
	            			->setComplexTypeStrategy($types)
	            			->setClass('Services\API\ServicesAPI')
	            			->setUri($this->sconfig['uri'])
	            			
	            // 			->setComplexTypeStrategy(new AnyType())
	            			//TODO classmap hinzufügen damit eine classe zurückgegeben werden kann
	            			
	            			->setClassMap($classmap)
	            			
				;			
				$autodiscover->generate();
				$autodiscover->handle();
			//}
			

		} else {

		    $options=array('cache_wsdl'   => 0,
		                  'trace'         => 1,
// 		                  'classmap'      => $classmap,
		                  
		    );
		    
		    //TODO eventuell später die Adresse anpassen
// 		    $basePath = $this->getRequest()->getBasePath();
// 		    ->setUri('http://'.$_SERVER['SERVER_NAME'].$basePath.'/soapserver/soap')
		    
			$soap = new Server($this->sconfig['wsdl'], $options);
			$soap->setClass($api);
			
			print_r($soap->getLastRequest());
// 			$soap->handle();

			//return new ViewModel(array(
			//		'groupen' => $this->getGroupTable()->fetchAll(),
			//));
			
			
// 			//--------------Zusatzinfos-----------------
// 			// Get a response as a return value of handle() method
// 			// instead of emitting it to the standard output
// 			$server->setReturnResponse(true);
// 			...
// 			$response = $server->handle();
// 			if ($response instanceof \SoapFault) {
// 			    ...
// 			} else {
// 			    ...
// 			}
	
// 			// oder
// 			$response = $server->getLastResponse();
		}
		return $this->getResponse();
	}
}
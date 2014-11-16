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

// TODO nach dem testen auskomentieren
use Zend\View\Model\ViewModel;

ini_set("soap.wsdl_cache_enabled", 0);

require_once 'API/servicesAPI.php';

class ServicesController extends AbstractActionController
{
	//TODO: Variablen auslagern
	private $_WSDL_URI="http://localhost/services?wsdl";
	private $_URI="http://localhost/services";

	protected $groupTable;

	public function getGroupTable()
	{
		if (!$this->groupTable) {
			$sm = $this->getServiceLocator();
			$this->groupTable = $sm->get('Services\Model\GroupTable');
		}
		return $this->groupTable;
	}

	public function wsdlAction()
	{
		$api = new servicesAPI();

		$autodiscover = new AutoDiscover();
		$autodiscover   ->setClass($api)
		->setUri($this->_URI)
		;
		$autodiscover->handle();

		return $this->getResponse();
	}

	public function indexAction()
	{
		$api = new servicesAPI();

		if(isset($_GET['wsdl'])) {
			$autodiscover = new AutoDiscover();
			$autodiscover   ->setClass($api)
			->setUri($this->_URI);
			$autodiscover->handle();

			return $this->getResponse();

		} else {
			 
			$soap = new Server($this->_WSDL_URI);
			$soap->setClass($api);
			$soap->handle();

			//return new ViewModel(array(
			//		'groupen' => $this->getGroupTable()->fetchAll(),
			//));

		}
		return $this->getResponse();
	}
}
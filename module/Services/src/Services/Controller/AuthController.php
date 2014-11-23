<?php
namespace Services\Controller;

class Authentification{
	//TODO http://blog.routydevelopment.com/2010/01/soap-authenticatation-using-soap-headers-api-class-client-server-wsdl-generation-examples/
	public $IsAuthentificated = false;
	
	function __construct($username,$password){
		
		if(strlen(trim($username)) > 0 && trim($username) == "adm" && strlen(trim($password)) > 0 && trim($password) == "pwd") 		
			$this->IsAuthentificated = true;
		else 
			$this->IsAuthentificated = false;
	}
}
?>






























// namespace Auth\Controller\Plugin;

// use Zend\Mvc\Controller\Plugin\AbstractPlugin;
// use Zend\EventManager\EventInterface as Event;
// use Zend\Authentication\AuthenticationService;

// use Doctrine\ORM\EntityManager;
// use Auth\Entity\User;
// use Zend\Mvc\MvcEvent;

// use Zend\ServiceManager\ServiceManagerAwareInterface;
// use Zend\ServiceManager\ServiceManager;
// class AclPlugin extends AbstractPlugin implements ServiceManagerAwareInterface
// {

//     /*
//      * @var Doctrine\ORM\EntityManager
//      */
//     protected $em;

//     protected $sm;

//     public function checkAcl($e)
//     {

//         $this->setServiceManager( $e->getApplication()->getServiceManager() );

//         $auth = new AuthenticationService();
//         if ($auth->hasIdentity()) {
//             $storage = $auth->getStorage()->read();
//             if (!empty($storage->role))
//                 $role = strtolower ( $storage->role );
//             else
//                 $role = "guest";
//         } else {
//             $role = "guest";
//         }
//         $app = $e->getParam('application');
//         $acl          = new \Auth\Acl\AclRules();

//         $matches      = $e->getRouteMatch();
//         $controller   = $matches->getParam('controller');
//         $action       = $matches->getParam('action', 'index');

//         $resource = strtolower( $controller );
//         $permission = strtolower( $action );

//         if (!$acl->hasResource($resource)) {
//             throw new \Exception('Resource ' . $resource . ' not defined');
//         }

//         if ($acl->isAllowed($role, $resource, $permission)) {

//             $query = $this->getEntityManager($e)->createQuery('SELECT u FROM Auth\Entity\User u');
//             $resultIdentities = $query->execute();

//             var_dump($resultIdentities);
//             foreach ($resultIdentities as $r)
//                 echo $r->username;
//             exit();


//             return;

//         } else {
//             $matches->setParam('controller', 'Auth\Controller\User'); // redirect
//             $matches->setParam('action', 'accessdenied');

//             return;
//         }

//     }



//     public function getEntityManager() {

//         if (null === $this->em) {
//             $this->em = $this->sm->getServiceLocator()->get('doctrine.entitymanager.orm_default');

//         }
//         return $this->em;
//     }

//     public function setEntityManager(EntityManager $em) {
//         $this->em = $em;
//     }

//     /**
//      * Retrieve service manager instance
//      *
//      * @return ServiceManager
//      */
//     public function getServiceManager()
//     {
//         return $this->sm->getServiceLocator();
//     }

//     /**
//      * Set service manager instance
//      *
//      * @param ServiceManager $locator
//      * @return void
//      */
//     public function setServiceManager(ServiceManager $serviceManager)
//     {
//         $this->sm = $serviceManager;
//     }

// }
// ?>
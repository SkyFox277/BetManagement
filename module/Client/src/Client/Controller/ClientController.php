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
    

    // TODO das 2. Password soll in der SESSION gespeichert werden und über den SOAP Header abgefragt werden
    // Dieser 2. password soll automatisch für die aktuelle session generiert und in der DB beim Anmelden gespeichert werden
    
    // TODO Ablauf:
    /**
     * auf die Seite gekommen egal wohin : => Wilkommen, Login => Authentifizierung => index
     * Register: Daten speichern => Login
     * Eingeloggt: => index
     * .....
     */
    
    // TODO DB User Spalten: HeaderPassword, Eingeloggt_bis
    
    // TODO zunächst vielleicht nur normalle Authentifizierung PW + 2.PW Danach auf ZFC umsteigen...
    
    
    const ROUTE_LOGIN = 'client/login';
    const ROUTE_REGISTER = 'client/register';
    const CONTROLLER_NAME = 'client';

    /**
     *
     * @var Form
     */
    protected $loginForm;

    /**
     *
     * @var Form
     */
    protected $registerForm;
    
    public function __construct()
    {

    }
    
    /**
     * Einstiegsfunktion des Soap-Clients.
     * (non-PHPdoc)
     * 
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
//         if (!$this->userAuthentication) {
//             return $this->redirect()->toRoute(static::ROUTE_LOGIN);
//         }
        
//         try {
//             return $this->redirect()->toRoute(static::ROUTE_LOGIN);
//         } catch (\Exception $e) {
//                     echo $e->getCode();
//                     echo $e->getLine();
//                     echo $e->getMessage();
//                     echo $e->getTrace();
//                     echo $e->__toString();
//         }
        
        
        $client = self::getZSClient();
        
        
        try {
            $response = $client->hello();
            
            echo $response;
        } catch (\SoapFault $e) {
            
            if ($e->getMessage() == 401) {
                echo "falsche LogIn Daten!!!";
            }
        } catch (\Exception $e) {
            echo "Es ist ein fehler auf der Webseite aufgetreten.";
        }
        
        // ?????????????????????????
        /**
         * _preProcessArguments
         *
         * setUserAgent
         */
        
//         $res = $client->authenticate($auth_vals);
        
//         echo "<pre>";
//         var_dump($res);
//         echo "</pre>";
        
//         echo "<br>----------TESTS------------";
        
//         echo $client->getClassmap();
        
//         echo "<br>" . $client->signin();
        
//         echo "<pre>";
//         var_dump($client->getLastRequest());
//         echo "</pre>";
        
//         echo "<br>----------------------";
//         echo "<br>";
        
//         echo "<pre>";
//         var_dump($client->getLastRequestHeaders());
//         echo "</pre>";
        
//         echo "<br>----------------------";
//         echo "<br>";
        
//         echo "<pre>";
//         var_dump($client->getLastResponse());
//         echo "</pre>";
        
//         echo "<br>----------------------";
//         echo "<br>";
        
//         echo "<pre>";
//         var_dump($client->getLastResponseHeaders());
//         echo "</pre>";
        
//         echo "<br>----------------------";
        
        return new ViewModel();
    }
    
    public function groupsAction()
    {
        if (!$this->userAuthentication) {
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }
    
        $client = self::getZSClient();
    
    
        try {
            $response = $client->hello();
    
            echo $response;
        } catch (\SoapFault $e) {
    
            if ($e->getMessage() == 401) {
                echo "falsche LogIn Daten!!!";
            }
        } catch (\Exception $e) {
            echo "Es ist ein fehler auf der Webseite aufgetreten.";
        }
    
        return new ViewModel();
    }
    
    /**
     * Login form
     */
    public function loginAction()
    {
        if ($this->userAuthentication) {
            return $this->redirect()->toRoute(static::CONTROLLER_NAME);
        }

        return $this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'authenticate'));
    }
    
    /**
     * Logout and clear the identity
     */
    public function logoutAction()
    {
        if ($this->userAuthentication) {
            $this->userAuthentication = false;
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }
        
        return new ViewModel();
    }
    
    /**
     * General-purpose authentication action
     */
    public function authenticateAction()
    {
        if ($this->userAuthentication) {
            return $this->redirect()->toRoute(static::CONTROLLER_NAME);
        }
        
        $client = $this->getZSClient(false);
        $client->resetSoapInputHeaders();
        
        $auth = new \stdClass();
        $auth->username = 'fake_user';
        $auth->password = 'fake_pass';
        
        $response = $client->login($auth);
        
        if ($response){
            return $this->redirect()->toRoute(static::CONTROLLER_NAME);
        }else{
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
            
//             return $this->forward()->dispatch(static::CONTROLLER_NAME, 
//                                                 array('action'      => 'login',
//                                                     'redirect_from' => 'authenticate'
//                                                     )
//                                                 );
        }
    }
    
    /**
     * Register new user
     */
    public function registerAction()
    {
        
        return new ViewModel();
    }
    
    /**
     * 
     * @return \Zend\Soap\Client
     */
    protected function getZSClient($withHeader = true) {
        
        $sconfig = $this->getServiceLocator()->get('Config')['ServerConfig'];
        $options = array(
            'compression' => SOAP_COMPRESSION_ACCEPT,
            'cache_wsdl' => 0,
            'soap_version' => SOAP_1_2
        );
        
        $client = new Client($sconfig['wsdl'], $options);
        
        if ($withHeader){
            $auth = new \stdClass();
            $auth->username = 'fake_user2';
            $auth->password = 'fake_pass2';
            $auth_vals = new \SoapVar($auth, SOAP_ENC_OBJECT);
            $authenticate = new \SoapHeader($sconfig['location'], 
                                            'authenticate', 
                                            array($auth), 
                                            true
                                            );
            
            $client->addSoapInputHeader($authenticate, false);
        }
        
        return $client;
    }
}

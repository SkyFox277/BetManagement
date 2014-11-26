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
use Zend\Form\Annotation\Object;


class ClientController extends AbstractActionController
{  
    const ROUTE_LOGIN        = 'client/login';
    const ROUTE_REGISTER     = 'client/register';
    
    const CONTROLLER_NAME    = 'zfcuser';
    
    /**
     * @var UserService
     */
    protected $userService;
    
    /**
     * @var Form
     */
    protected $loginForm;
    
    /**
     * @var Form
     */
    protected $registerForm;
    
    /**
     * @todo Make this dynamic / translation-friendly
     * @var string
     */
    protected $failedLoginMessage = 'Authentication failed. Please try again.';
    
    /**
     * @var UserControllerOptionsInterface
     */
    protected $options;
    
    //     public function __construct($userService, $options, $registerForm, $loginForm)
    //     {
    //         $this->userService = $userService;
    //         $this->options = $options;
    //         $this->registerForm = $registerForm;
    //         $this->loginForm = $loginForm;
    //     }
    /**
     * Einstiegsfunktion des Soap-Clients. (non-PHPdoc)
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $sconfig = $this->getServiceLocator()->get('Config')['ServerConfig'];
        $options = array('compression'  => SOAP_COMPRESSION_ACCEPT,
                        'cache_wsdl'    => 0,
                        'soap_version'  => SOAP_1_2,
        				'login' => 'Cazzador',
        				'password' => 'Skyfox'
        );
        
        
        echo "client </br>";
     	$client = new Client($sconfig['wsdl'], $options);

     	

     	$ns   = "Services\API";
     	
     	$auth = new \stdClass();
     	$auth->username = 'fake_user';
        $auth->password = 'fake_pass';

        $auth_vals    = new \SoapVar($auth, SOAP_ENC_OBJECT);

        //The 2nd variable, 'authenticate' is a method that exists inside of the SOAP service (you must create it, see next example)
        $authenticate = new \SoapHeader($sconfig['location'],'authenticate',$auth, true);

        
        $client->addSoapInputHeader($authenticate, false);
        echo $client->hello();
        
             	        echo "<pre>";
             	        var_dump($client->getLastRequest());
             	        echo "</pre>";
             	        
             	        echo "<pre>";
             	        var_dump($client->getLastRequestHeaders());
             	        echo "</pre>";
        
        //?????????????????????????
        /**
         * _preProcessArguments
         * addSoapInputHeader
         * setUserAgent
         */
        
        echo $client->hello();
        
//      	$res = $client->authenticate($auth_vals);
     	
//      	        echo "<pre>";
//      	        var_dump($res);
//      	        echo "</pre>";
     	
     	echo "<br>----------TESTS------------";
//      	echo  $client->getClassmap();

               
//         echo "<br>" .$client->signin();
        
        
        // Tests------------------------
        echo "<br>";
        //$result = $client->getGTable();
        
//         echo "<pre>";
//         var_dump($result);
//         echo "</pre>";
        
        echo "<br>----------------------";
        echo "<br>";
//         echo $client->getLastRequest();
        echo "<br>----------------------";
        echo "<br>"; 
//         echo $client->getLastResponse();
        echo "<br>----------------------";
        

        return new ViewModel();
    }
    
    
public function loginAction()
    {
        echo "test1 </br>";
               
        return new ViewModel();
    }
    
    
    public function registerAction()
    {
        // if the user is logged in, we don't need to register
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            // redirect to the login redirect route
            return $this->redirect()->toRoute($this->options->getLoginRedirectRoute());
        }
        // if registration is disabled
        if (!$this->options->getEnableRegistration()) {
            return array('enableRegistration' => false);
        }

        $request = $this->getRequest();
        $service = $this->userService;
        $form = $this->registerForm;

        if ($this->options->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
            $redirect = $request->getQuery()->get('redirect');
        } else {
            $redirect = false;
        }

        $redirectUrl = $this->url()->fromRoute(static::ROUTE_REGISTER)
            . ($redirect ? '?redirect=' . rawurlencode($redirect) : '');
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return array(
                'registerForm' => $form,
                'enableRegistration' => $this->options->getEnableRegistration(),
                'redirect' => $redirect,
            );
        }

        $post = $prg;
        $user = $service->register($post);

        $redirect = isset($prg['redirect']) ? $prg['redirect'] : null;

        if (!$user) {
            return array(
                'registerForm' => $form,
                'enableRegistration' => $this->options->getEnableRegistration(),
                'redirect' => $redirect,
            );
        }

        if ($service->getOptions()->getLoginAfterRegistration()) {
            $identityFields = $service->getOptions()->getAuthIdentityFields();
            if (in_array('email', $identityFields)) {
                $post['identity'] = $user->getEmail();
            } elseif (in_array('username', $identityFields)) {
                $post['identity'] = $user->getUsername();
            }
            $post['credential'] = $post['password'];
            $request->setPost(new Parameters($post));
            return $this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'authenticate'));
        }

        // TODO: Add the redirect parameter here...
        return $this->redirect()->toUrl($this->url()->fromRoute(static::ROUTE_LOGIN) . ($redirect ? '?redirect='. rawurlencode($redirect) : ''));
    }
}

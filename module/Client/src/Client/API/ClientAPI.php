<?php
namespace Client\API;

/**
 *
 * @author root
 *        
 */
class ClientAPI
{

    private static $instance = NULL;
    
    /**
     */
    function __construct()
    {}
    
    public static function getInstance() {
         
        if (!self::$instance) {
    
            $ns   = "auth";
            $wsdl = "http://location/tothisfile/Server.php?wsdl";
             
            //Create our Auth Object to pass to the SOAP service with our values
            $auth->username = 'fake_user';
            $auth->password = 'fake_pass';
    
            $auth_vals    = new SoapVar($auth, SOAP_ENC_OBJECT);
    
            //The 2nd variable, 'authenticate' is a method that exists inside of the SOAP service (you must create it, see next example)
            $authenticate = new SoapHeader($ns,'authenticate',$auth_vals, false);
             
            $client = new SoapClient($wsdl,array('cache_wsdl' => 0));
    
            $client->__setSoapHeaders(array($authenticate));
             
            self::$instance = $client;
        }
         
        return self::$instance;
    }
    
    
}

?>
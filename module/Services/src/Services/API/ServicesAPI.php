<?php
/**
 * @author JF
 * SOAP API
 */
 
namespace Services\API;

use Services\Model\Group;


class ServicesAPI
{
    protected $groupTable;
    
    /**
     * 
     * @var Group
     */
    protected $group;
    
    public function __construct() {

//     public function __construct(Adapter $adapter) {
//         self::$adapter = $adapter;
    }

    /**
     * 
     * @param object $login
     * @throws SOAPFault
     * @return string
     */
    public function authenticate($login)
    {
        if(!empty($login->username) && !empty($login->password)) {
            
            //add your own auth code here. I have it check against a database table and return a value if found.
    
            if(true) {
                 
                return $login->username;
                 
            } else {
                 
                throw new \SoapFault("Incorrect username and or password.", 401);
                 
            }
             
        } else {
             
            throw new \SOAPFault("Invalid username and password format. Values may not be empty and are case-sensitive.", 401);
    
        }
         
    }
    
    /**
     * Liefert eine Gruppen Tabelle zurück //TODO hier als rückgabe die Klasse
     * @return Group
     */
    public function getGTable()
    {
//         if (!$this->groupTable) {
//             $sm = $this->getServiceLocator();
//             $this->groupTable =  $sm->get('Services\Model\GroupTable');
//         }

        $data = array('id'          => 4,
                            'voicetag'      => 'DE',
                            'groupname'     => 'test1',
                            'isactive'      => 1 
        );
        
        $this->group = new Group($data);

//         return serialize($this->group);//         funktioniert mit return string

        
        return  $this->group;
    }
    
    /**
     * This method takes a value and gives back the md5 hash of the value
     *
     * @param String $value
     * @return String
     */
    public function md5Value($value) {
        return md5($value);
    }
    
    /**
     * Hello World
     * @return string
     */
    public function hello(){
        return 'Halli hallo halloly';
    }
    
    /**
     * Serverauthentification.
     * @return string
     */
    public function SignIn(){
    	return 'nothing';
    }
    
    /**
     * Cast Funktionalität
     * @param unknown $destination
     * @param stdClass $source
     */
    private static function Cast(&$destination, \stdClass $source)
    {
        $sourceReflection = new \ReflectionObject($source);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $name = $sourceProperty->getName();
            if (gettype($destination->{$name}) == "object") {
                self::Cast($destination->{$name}, $source->$name);
            } else {
                $destination->{$name} = $source->$name;
            }
        }
        return $destination;
    }
    
    // noch eine Cast Funktion //TODO später prüfen
//     function cast($destination, $sourceObject)
//     {
//         if (is_string($destination)) {
//             $destination = new $destination();
//         }
//         $sourceReflection = new ReflectionObject($sourceObject);
//         $destinationReflection = new ReflectionObject($destination);
//         $sourceProperties = $sourceReflection->getProperties();
//         foreach ($sourceProperties as $sourceProperty) {
//             $sourceProperty->setAccessible(true);
//             $name = $sourceProperty->getName();
//             $value = $sourceProperty->getValue($sourceObject);
//             if ($destinationReflection->hasProperty($name)) {
//                 $propDest = $destinationReflection->getProperty($name);
//                 $propDest->setAccessible(true);
//                 $propDest->setValue($destination,$value);
//             } else {
//                 $destination->$name = $value;
//             }
//         }
//         return $destination;
//     }

    private function cast_serealize($to_class, $obj) {
        if(class_exists($to_class)) {
            $obj_in = serialize($obj);
            $obj_out = 'O:' . strlen($to_class) . ':"' . $to_class . '":' . substr($obj_in, $obj_in[2] + 7);
            return unserialize($obj_out);
        }
        else
            return false;
    }
}
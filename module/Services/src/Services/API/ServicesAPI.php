<?php
/**
 * @author JF
 * SOAP API
 */
 
namespace Services\API;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;
use Services\Model\GroupTable;
use Services\Controller\ReturnableClass;
use Zend\Db\Adapter\Adapter;
use Zend\Di\Definition\ClassDefinition;
use Services\Model\Group;

class ServicesAPI
{
    protected $groupTable;
    protected $group;
    
    public function __construct() {

//     public function __construct(Adapter $adapter) {
//         self::$adapter = $adapter;
    }

    /**
     * Liefert eine Gruppen Tabelle zurück
     * @return Group
     */
    public function getGroupTable()
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
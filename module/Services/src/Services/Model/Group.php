<?php
namespace Services\Model;

use Zend\XmlRpc\Value\String;
use Zend\Filter\Int;
use Zend\Db\Sql\Ddl\Column\Date;

/**
 * 
 * @author SkyFox277
 *
 */
class Group
{
    /**
     * 
     * @var Int
     */
    public $id;
    /**
     * 
     * @var String
     */
    public $voicetag;
    /**
     *  
     * @var String
     */
    public $groupname;
    /**
     * 
     * @var Date
     */
    public $creationdate;
    /**
     * 
     * @var Int
     */
    public $isactive;
    /**
     * 
     * @var Int
     */
    public $ownerid;

    /**
     * 
     * @param array $data
     */
    public function __construct($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->voicetag = (isset($data['voicetag'])) ? $data['voicetag'] : null;
        $this->groupname  = (isset($data['groupname'])) ? $data['groupname'] : null;
        $this->creationdate     = (isset($data['creationdate'])) ? $data['creationdate'] : null;
        $this->isactive = (isset($data['isactive'])) ? $data['isactive'] : null;
        $this->ownerid  = (isset($data['ownerid'])) ? $data['ownerid'] : null;
    }
    
    /**
     * 
     * @param array $data
     */
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->voicetag = (isset($data['voicetag'])) ? $data['voicetag'] : null;
        $this->groupname  = (isset($data['groupname'])) ? $data['groupname'] : null;
        $this->creationdate     = (isset($data['creationdate'])) ? $data['creationdate'] : null;
        $this->isactive = (isset($data['isactive'])) ? $data['isactive'] : null;
        $this->ownerid  = (isset($data['ownerid'])) ? $data['ownerid'] : null;
    }
}


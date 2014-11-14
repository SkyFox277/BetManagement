<?php
namespace Services\Model;

class Group
{
    public $id;
    public $voicetag;
    public $groupname;
    public $creationdate;
    public $isactive;
    public $ownerid;

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


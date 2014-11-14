<?php
namespace Services\Model;

use Zend\Db\TableGateway\TableGateway;

class GroupTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getGroup($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveGroup(Group $group)
    {
        $data = array(
            'id'            => $group->id,
            'voicetag'      => $group->voicetag,
            'groupname'     => $group->groupname,
            'creationdate'  => $group->creationdate,
            'isactive'      => $group->isactive,
            'ownerid'       => $group->ownerid,
        );

        $id = (int)$group->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getGroup($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteGroup($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}
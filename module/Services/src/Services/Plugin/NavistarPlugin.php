<?php

namespace Services\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\DriverInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select as Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

class NavistarPlugin extends AbstractPlugin{
   
    protected $adapter;
   
    public function __construct(Adapter $adapter){
        $this->adapter = $adapter;
    }

    
}
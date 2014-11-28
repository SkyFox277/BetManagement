<?php
namespace Client\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * IndexController
 *
 * @author
 *
 * @version
 *
 */
class IndexController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        return new ViewModel();
    }
}
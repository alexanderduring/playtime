<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }



    public function listAction()
    {
        // Read files
        $musicDirectory = $this->getServiceLocator()->get('musicDirectory');
        $files = $musicDirectory->getFiles();

        $view = new ViewModel();
        $view->files = $files;

        return $view;
    }



    public function showAction()
    {
        $mvcEvent = $this->getEvent();
        $filekey = $mvcEvent->getRouteMatch()->getParam('filekey');

        // Read files
        $musicDirectory = $this->getServiceLocator()->get('musicDirectory');
        $files = $musicDirectory->getFiles();

        $view = new ViewModel();
        $view->filekey = $filekey;
        $view->file = $files[$filekey];

        return $view;
    }
}

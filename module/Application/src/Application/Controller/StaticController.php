<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

/**
 * @author Alexander During
 */
class StaticController extends AbstractActionController
{
    public function getAction()
    {
        $mvcEvent = $this->getEvent();
        $filekey = $mvcEvent->getRouteMatch()->getParam('filekey');
        $filetype = $mvcEvent->getRouteMatch()->getParam('type');

        // Read files
        $musicDirectory = $this->getServiceLocator()->get('musicDirectory');
        $files = $musicDirectory->getFiles();
        $filename = $files[$filekey]['name'];

        $musicDir = '/home/alexander/Musik';
        $fullpath = $musicDir.'/'.$filename;

        $mimeTypes = array(
            'mp3' => 'audio/mpeg'
        );

        if (file_exists($fullpath)) {
            $filesize = filesize($fullpath);
            header('Content-Type: '.$mimeTypes[$filetype]);
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            header('Content-Length: '. filesize($fullpath));
            readfile($fullpath);
            exit;
        } else {
            $view = new ViewModel(array('errorCode' => 'DocumentNotFound'));
            $view->setTemplate('error/index');

            return $view;
        }

    }
}

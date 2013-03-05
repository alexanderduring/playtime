<?php

namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Model\MusicDirectory;


class MusicDirectoryFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $musicDirectoryConfig = isset($config['musicDirectory']) && (is_array($config['musicDirectory']) || $config['musicDirectory'] instanceof ArrayAccess) ? $config['musicDirectory'] : array();

        if (isset($musicDirectoryConfig['path'])) {
            $path = $musicDirectoryConfig['path'];

            $musicDirectory = new MusicDirectory($path);
        } else {
            $musicDirectory = null;
        }

        return $musicDirectory;
    }
}

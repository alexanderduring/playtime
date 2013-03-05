<?php

namespace Application\Model;

class MusicDirectory
{
    private $path = null;
    private $directory = null;



    public function __construct($path)
    {
        $this->path = $path;
        $directory = dir($path);
        if (!is_null($directory) && $directory !== false) {
            $this->directory = $directory;
        }
    }



    public function getFiles()
    {
        $files = $this->getDirectoryContent($this->path);

        return $files;
    }



    private function getDirectoryContent($directoryPath, $subPath = '')
    {
        $path = ($subPath != '') ? $directoryPath.'/'.$subPath : $directoryPath;

        $files = array();
        $directoryHandle  = opendir($path);
        while (false !== ($filename = readdir($directoryHandle))) {

            if (is_dir($path.'/'.$filename)) {
                if (!in_array($filename, array('.', '..'))) {
                    $subPath2 = ($subPath != '') ? $subPath.'/'.$filename : $filename;
                    $files2 = $this->getDirectoryContent($directoryPath, $subPath2);
                    $files = array_merge($files, $files2);
                }
            } else {
                $files[] = array('name' => $filename, 'path' => $subPath);
            }
        }

        return $files;
    }
}

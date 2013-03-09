<?php

/**
* Licensed under The Apache License
*
* @copyright Copyright 2013 Patrick Farnkopf
* @link https://github.com/PatrickFarnkopf/pCMS
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

namespace Classes;

class Tar {
    const TYPE_DIRECTORY = 5;

    private $file, $header, $content;
    public function __construct($filename) {
        if (!file_exists($filename))
            throw new \Exception("Can not open file $filename. File does not exist!", 0x0A);
        
        $this->file = fopen($filename, 'rb');
        $this->header = $this->readHeader();
    }

    private function readHeader() {
        $header = [];
        while (strlen($bin = fread($this->file, 512)) !== 0) {
            $this->headerBin[] = $bin;
            $data = unpack("a100filename/a8mode/a8uid/a8gid/a12size/a12mtime/a8checksum/a1typeflag/a100link/a6magic/a2version/a32uname/a32gname/a8devmajor/a8devminor/a155prefix", $bin);
            
            $data['offset'] = ftell($this->file);
            
            if($data['typeflag'] == Tar::TYPE_DIRECTORY) 
                $data['size'] = 0;
            else
                $data['size'] = octdec($data['size']);

            if($data['size'] == 0 && $data['typeflag'] != Tar::TYPE_DIRECTORY) 
                continue;

            fseek($this->file, ftell($this->file) + 512 * ceil($data['size'] / 512));
            
            $header[] = $data;
        }

        return $header;
    }

    public function getFileNames() {
        $fileName = [];
        for ($i=0;$i<count($this->header);$i++) {
            $fileName[] = $this->header[$i]['filename'];
        }
        return $filename;
    }

    public function extract($filename, $destination) {
        for ($i=0;$i<count($this->header);$i++) {
            if ($filename == $this->header[$i]['filename']) {
                fseek($this->file, $this->header[$i]['offset']);
                touch($destination.'/'.$this->header[$i]['filename']);
                file_put_contents($destination.'/'.$this->header[$i]['filename'], fread($this->file, $this->header[$i]['size']));
                return true;
            }
        }

        return false;
    } 
}

?>

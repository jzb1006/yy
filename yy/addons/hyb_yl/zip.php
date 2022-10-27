<?php
class zip{

    
    function zipFolder($folderPath, $zipAs){
    	// require_once(IA_ROOT . '/framework/library/phpexcel/PHPExcel/Shared/ZipArchive.php');
        // require_once(IA_ROOT . '/framework/library/phpexcel/PHPExcel/Shared/ZipArchive.php');
            // $za = new ZipArchive();
            
        $folderPath = (string)$folderPath;
        $zipAs = (string)$zipAs;
        if(!class_exists('ZipArchive')){
                return false;
        }
        
        if(!$files=$this->scanFolder($folderPath, true, true)){
                return false;
        }
        
        $za = new ZipArchive;

        if(true!==$za->open($zipAs, ZipArchive::OVERWRITE | ZipArchive::CREATE)){
                return false;
        }
        $za->setArchiveComment(base64_decode('LS0tIHd1eGlhbmNoZW5nLmNuIC0tLQ==').PHP_EOL.date('Y-m-d H:i:s'));
        
        foreach($files as $aPath => $rPath){
                $za->addFile($aPath, $rPath);
        }
        if(!$za->close()){
                return false;
        }
        return true;
    }
    function scanFolder($path='', $recursive=true, $noFolder=true, $returnAbsolutePath=false,$depth=0){
        $path = (string)$path;
        if(!($path=realpath($path))){
                return false;
        }
        $path = str_replace('\\','/',$path);
        if(!($h=opendir($path))){
                return false;
        }
        $files = array();
        static $topPath;
        $topPath = $depth===0||empty($topPath)?$path:$topPath;
        while(false!==($file=readdir($h))){
                if($file!=='..' && $file!=='.'){
                        $fp = $path.'/'.$file;
                        if(!is_readable($fp)){
                                continue;
                        }
                        if(is_dir($fp)){
                                $fp .= '/';
                                if(!$noFolder){
                                        $files[$fp] = $returnAbsolutePath?$fp:ltrim(str_replace($topPath,'',$fp),'/');
                                }
                                if(!$recursive){
                                        continue;
                                }
                                $function = __FUNCTION__;
                                $subFolderFiles = $function($fp, $recursive, $noFolder, $returnAbsolutePath, $depth+1);
                                if(is_array($subFolderFiles)){
                                        $files = array_merge($files, $subFolderFiles);
                                }
                        }else{
                                $files[$fp] = $returnAbsolutePath?$fp:ltrim(str_replace($topPath,'',$fp),'/');
                        }
                }
        }
        return $returnAbsolutePath?array_values($files):$files;
    }

    
}
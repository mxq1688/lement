<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/25
 * Time: 0:15
 */

namespace core\lib\drive\log;
class file {
    public $path;
    public function __construct()
    {
        $this->path = C('OPTION')['PATH'];
    }
    public function log($content,$path){
        if($content != null){
            if($path == null){
                $path = $this->path;
            }
            if(!is_dir($path)){
                mkdir($path, '0777', true);
            }
            $content = json_encode($content);
            $path = $path . '/'. date('Y-m-d'). '.log';
            return file_put_contents($path, $content.PHP_EOL, FILE_APPEND);
        }

    }



}
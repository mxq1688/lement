<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/25
 * Time: 0:12
 */
namespace core\lib;

class log {

    public static $class;
    public function __construct()
    {

    }
    public static function init(){
        $drive = C('DRIVE');
        $class = '\core\lib\drive\log\\'. $drive;
        self::$class = new $class;
    }
    public static function log($content,$path){
        return self::$class-> log($content,$path);
    }

}
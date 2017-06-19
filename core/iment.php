<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19
 * Time: 13:42
 */
    namespace core;

    class iment{
        static public $classArr = array();
        function __construct()
        {

        }

        static public function run(){
            $route = new \core\lib\route();
            var_dump($route);
        }
        static public function load($class){

            $class = str_replace('\\', '/', $class);
            if(isset(self::$classArr[$class])){
                return true;
            }else{
                $file = IMENT .'/'. $class. '.php';
                if(is_file($file)){
                    include_once $file;
                    self::$classArr[$class] = $class;
                }else{
                    echo $class.'类文件不存在';
                }
            }
        }
    }
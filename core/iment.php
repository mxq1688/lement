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
            $model = $route->model;
            $ctrl = $route-> ctrl;
            $action = $route-> action;
            C('MODULE',$model);
            $ctrlfile = IMENT. '/'. $model. '/ctrl/'. $ctrl. 'ctrl.php';
            $ctrlClass = '\\'. $model. '\\ctrl\\'. $ctrl. 'Ctrl';
            $funcfile = IMENT. "/". $model. '/common/function.php';
            $config = CORE . '/config/config.php';
            $configfile = IMENT. "/". $model. '/config/config.php';
            if(is_file($config)){
                C(load_config($config));
            }
            if(is_file($funcfile)){
                include_once $funcfile;
            }
            if(is_file($configfile)){
                C(load_config($configfile));
            }
//            if(is_file($configfile)){
//                $configP = include_once $configfile;
//                $config = $configP + $config;
//            }

            //下面的这个不需要include 可以使用自动加载  只要这句就行$ctrl = new $ctrlClass()，不明白为什么像下面要这么写
            if(is_file($ctrlfile)){
                $controller = new $ctrlClass();
                $controller-> $action();
            }else{
                //抛出异常
                throw new \Exception('找不到控制器'. $ctrl. 'Ctrl');
            }

            //var_dump($route);
        }
        //自动加载
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
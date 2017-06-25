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
            $config = CORE . '/config/config.php';//框架默认配置
            if(is_file($config)){
                C(load_config($config));//加入配置参数
            }

            $route = new \core\lib\route();
            $model = $route->model;
            $ctrl = $route-> ctrl;
            $action = $route-> action;
            define('MODULE', $model);//定义模块名
            define('CONTRO', $ctrl);//定义控制器
            define('ACTION', $action);//定义方法
//            CC();//加载默认配置项
            //加载个人函数库
            $funcfile = IMENT. "/". $model. '/common/function.php';//个人函数库
            if(is_file($funcfile)){
                include_once $funcfile;
            }

            //加载个人配置文件
            if(is_dir(IMENT. '/'. MODULE. '/config')){
                $filenameA = scandir(IMENT. '/'. MODULE. '/config');
                foreach ($filenameA as $key=> $value){
                    $filename = IMENT. '/'. MODULE. '/config/' . $value;
                    if($value != '.' && $value != '..' && is_file($filename)){
                        C(load_config($filename));
                    }
                }
            }

            //初始化日志类
            \core\lib\log::init();


            //下面的这个不需要include 可以使用自动加载  只要这句就行$ctrl = new $ctrlClass()，不明白为什么像下面要这么写
            $ctrlfile = IMENT. '/'. $model. '/ctrl/'. $ctrl. 'ctrl.php';
            $ctrlClass = '\\'. $model. '\\ctrl\\'. $ctrl. 'Ctrl';
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
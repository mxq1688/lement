<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/24
 * Time: 0:38
 */
    namespace core\lib;
//不用此方法
    class conf {
        public static $config =array();
        //设置配置项
        public function setConfig(){
            //设置默认配置项
            $config = CORE . '/config/config.php';//框架默认配置
            if(is_file($config)){
                self::$config = load_config($config);//加载配置文件
            }
            $filenameA = scandir(IMENT. '/'. MODULE. '/config');

            foreach ($filenameA as $key=> $value){
                $filename = IMENT. '/'. MODULE. '/config/' . $value;
                if($value != '.' && $value != '..' && is_file($filename)){
                    $configP = include $filename;
                    self::$config = array_merge(self::$config, array_change_key_case($configP,CASE_UPPER));
                }
            }
        }
        //读取配置项
        public function getConfig($key){
            return $conf = self::$config[$key];
        }
    }
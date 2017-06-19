<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19
 * Time: 14:02
 */
    namespace core\lib;

    class route{
        public $ctrl;
        public $action;
        function __construct()
        {   //隐藏index.php  .htaccess文件
            if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/'){
                $path = $_SERVER['PATH_INFO'];
                $path_arr = explode('/', trim($path, '/'));
                if(isset($path_arr)){
                    $this->ctrl = $path_arr[0];
                    unset($path_arr[0]);
                }
                if(isset($path_arr[1])){
                    $this->action = $path_arr[1];
                    unset($path_arr[1]);
                }else{
                    $this->action = 'index';
                }
                for($i=2; $i< count($path_arr) + 2; $i = $i +2 ){
                    if(isset($path_arr[$i+1])){
                        $_GET[$path_arr[$i]] = $path_arr[$i+1];
                    }else{
                        $_GET[$path_arr[$i]] = null;
                    }
                }
            }else{
                $this->ctrl = 'index';
                $this->action = 'index';
            }
        }
    }
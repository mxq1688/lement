<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19
 * Time: 14:02
 */
    namespace core\lib;
    //路由类
    class route{
        public $model;
        public $ctrl;
        public $action;
        function __construct()
        {

            //隐藏index.php  .htaccess文件
            if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/'){
                $path = $_SERVER['PATH_INFO'];
                $path_arr = explode('/', trim($path, '/'));
                if(isset($path_arr)){
                    $this->model = $path_arr[0];
                    unset($path_arr[0]);
                }
                if(isset($path_arr[1])){
                    $this->ctrl = $path_arr[1];
                    unset($path_arr[1]);
                }else{
                    $this->ctrl = C('CONTRO');
                }
                if(isset($path_arr[2])){
                    $this->action = $path_arr[2];
                    unset($path_arr[2]);
                }else{
                    $this->action = C('ACTION');
                }
                for($i=3; $i< count($path_arr) + 2; $i = $i +2 ){
                    if(isset($path_arr[$i+1])){
                        $_GET[$path_arr[$i]] = $path_arr[$i+1];
                    }else{
                        $_GET[$path_arr[$i]] = null;
                    }
                }
        }else{
                $this->model = C('MODULE');
                $this->ctrl = C('CONTRO');
                $this->action = C('ACTION');
            }
        }
    }
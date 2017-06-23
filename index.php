<?php
/*
    1、定义常量
    2、引入函数库
    3、启动框架
*/
    // 检测PHP环境
    if(version_compare(PHP_VERSION,'5.6.0','<'))  die('require PHP > 5.6.0 !');
//    define('IMENT', realpath('./'));
    define('IMENT', dirname(__FILE__));
    define('CORE', IMENT. '/core');
    define('APP', IMENT. '/app');
//    define('MODULE', 'app');
    define('DEBUG', true);
    //debug 调试模式
    if(DEBUG){
        ini_set('display_errors', 'On');
    }else{
        ini_set('display_errors', 'Off');
    }
    //引入公共函数库
    include_once CORE. "/common/function.php";
    include_once CORE. "/iment.php";

    //自动加载
    spl_autoload_register("\core\iment::load");

    //启动框架
    \core\iment::run();

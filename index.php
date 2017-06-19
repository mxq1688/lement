<?php
/*
    1、定义常量
    2、引入函数库
    3、启动框架
*/
    define('IMENT', realpath('./'));
    define('CORE', IMENT. '/core');
    define('APP', IMENT. '/app');
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

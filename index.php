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
    define('VENDOR', IMENT. '/vendor');

    //入口文件目录绝对路径
    define('SITE_ROOT', IMENT);
    //数据缓存目录绝对目录
    defined('DATA_PATH') or define('DATA_PATH', SITE_ROOT . '/data');

//引入自动加载  用于第三方类的加载     也可以加载框架的类   命名空间命名规则一定要对
    include  "vendor/autoload.php";

    define('DEBUG', true);
    //debug 调试模式
    if(DEBUG){
//        $whoops = new \Whoops\Run;
//        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//        $whoops->register();
        //smarty调试
        define('APP_DEBUG', true);
        ini_set('display_errors', 'On');
    }else{
        ini_set('display_errors', 'Off');
    }
    //引入公共函数库
//    include_once CORE. "/common/function.php";
    include_once CORE. "/iment.php";


    //自动加载  可以使用composer 中的autoload.php实现自动加载
//    spl_autoload_register("\core\iment::load");

    //启动框架
    \core\iment::run();

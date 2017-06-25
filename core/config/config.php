<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 22:50
 */
    return array(
        'DB_TYPE' => 'mysql', // 数据库类型
        'DB_HOST' => 'localhost', // 服务器地址
        'DB_NAME' => 'wellsigncn', // 数据库名
        'DB_USER' => 'root', // 用户名
        'DB_PWD' => 'root', // 密码
        'DB_PORT' => '3306', // 端口
        'DB_PREFIX' => '', // 表前缀


        'MODULE' => 'app',//默认模块名
        'CONTRO' => 'index',
        'ACTION' => 'index',

        'DRIVE' => 'file',//日志记录方式
        'OPTION' => array(
            'PATH' => IMENT. '/log',
        ),

        //其他配置  第三方sdk  key等
    );
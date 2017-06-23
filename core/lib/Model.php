<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 22:10
 */
    namespace core\lib;

    class Model extends \PDO {
        //使用配置文件中的  数据库配置

        public function __construct()
        {
            $dsn = C('DB_TYPE') .':host='. C('DB_HOST') .';dbname='. C('DB_NAME');
            $username = C('DB_USER');
            $passwd = C('DB_PWD');
            echo $passwd;
            try{
                parent::__construct($dsn, $username, $passwd);
            }catch (\PDOException $e){
                dump($e -> getMessage());
            }
        }

        //分装写常用数据库操作方法


    }
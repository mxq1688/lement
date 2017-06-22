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

        public $dsn = 'mysql:host=localhost;dbname=wellsigncn';
        public $username = 'root';
        public $passwd = 'root';
        public $options = '';
        public function __construct()
        {
            $dsn = $this->dsn;
            $username = $this->username;
            $passwd = $this->passwd;
            $options = $this-> options;
            try{
                parent::__construct($dsn, $username, $passwd);
            }catch (\PDOException $e){
                dump($e -> getMessage());
            }
        }

        //分装写常用数据库操作方法


    }
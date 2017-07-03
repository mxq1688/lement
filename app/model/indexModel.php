<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 21:53
 */
    namespace app\model;

    class indexModel extends baseModel  {
        public function __contruct(){
            parent:: __contruct();
        }

        public function getuser(){
            return $this->select('user_info','*');
        }
    }
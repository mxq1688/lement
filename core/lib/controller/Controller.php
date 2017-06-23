<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 21:28
 */
    namespace core\lib\controller;

    abstract class Controller {
        public $assign = array();
        public $display;
        public function __construct()
        {
        }

        public function assign($key,$value){
            $this->assign[$key] = $value;
        }
        public function display($html=null){
            extract($this->assign);
            $file = IMENT. '/'. MODULE. '/view/'. CONTRO;
            if(empty($html)){
                $file = $file. '/'. CONTRO . '.html';
            }else{
                $file = $file. '/'. $html. '.html';
            }
            if(is_file($file)){
                include $file;
            }else{
                throw new \Exception('找不到视图文件'. CONTRO. '.html');
            }

        }

    }
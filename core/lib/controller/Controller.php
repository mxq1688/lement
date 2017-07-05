<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 21:28
 */
    namespace core\lib\controller;

    abstract class Controller {
        public $tpl;
        public $assign = array();
        public function __construct()
        {
            //smarty实例化
            $this->tpl = new \Smarty;
            $this->tpl->left_delimiter = "{";
            $this->tpl->right_delimiter = "}";
            $this->tpl->setTemplateDir(SITE_ROOT .'/'. MODULE.  '/views/'); //设置模板目录
            $this->tpl->setCompileDir(SITE_ROOT .'/'. MODULE. '/data/cache/templates_c/');
            $this->tpl->setConfigDir(SITE_ROOT . '/views/smarty_configs/');
            $this->tpl->setCacheDir(SITE_ROOT . '/data/cache/smarty_cache/');
            //$this->tpl->force_compile = true;
            if (APP_DEBUG) {
                //$this->tpl->debugging      = true;
                $this->tpl->caching        = false;
                $this->tpl->cache_lifetime = 0;
            } else {
                //$this->tpl->debugging      = false;
                $this->tpl->caching        = true;
                $this->tpl->cache_lifetime = 120;
            }

        }

        public function assign($key,$value){
//            $this->assign[$key] = $value;
            $this->tpl->assign($key, $value);
        }
        public function display($html=null){
//            extract($this->assign);
//            $file = IMENT. '/'. MODULE. '/views/'. CONTRO;
            $file = CONTRO;
            if(empty($html)){
                $file = $file. '/'. ACTION . '.html';
            }else{
                $file = $file. '/'. $html. '.html';
            }

//            if(is_file($file)){

                $this->tpl->display($file);
//                include $file;
//            }else{
//                throw new \Exception('找不到视图文件'. CONTRO. '.html');
//            }

        }

    }
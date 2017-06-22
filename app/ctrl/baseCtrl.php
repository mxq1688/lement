<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 21:17
 */
    namespace app\ctrl;
    use core\lib\Controller;

    class baseCtrl extends Controller {
        public function __construct()
        {
            parent:: __construct();
        }
        //可以自定义一些常用类方法
        public function base(){

        }
    }
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/22
 * Time: 20:31
 */
    namespace app\ctrl;

    use Medoo\Medoo;

    class  indexCtrl extends baseCtrl {
        function __construct()
        {
            parent:: __construct();
        }
        public function index(){
            echo 'ok';
//            $user = M()->query('select * from user_info');
//            $user = D('index')->getuser();
//            dump($user);
//            echo addLog('sze');
            dump(M()->select("user_info","*"));
            $data = 'fesr';
            $this->assign('data', $data);
            $this->display();

        }
    }
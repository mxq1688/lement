<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19
 * Time: 13:42
 */

    /**
     * 获取和设置配置参数 支持批量定义
     * @param string|array $name 配置变量
     * @param mixed $value 配置值
     * @param mixed $default 默认值
     * @return mixed
     */
    function C($name=null, $value=null,$default=null) {
        static $_config = array();
        // 无参数时获取所有
        if (empty($name)) {
            return $_config;
        }
        // 优先执行设置获取或赋值
        if (is_string($name)) {
            if (!strpos($name, '.')) {
                $name = strtoupper($name);
                if (is_null($value))
                    return isset($_config[$name]) ? $_config[$name] : $default;
                $_config[$name] = $value;
                return null;
            }
            // 二维数组设置和获取支持
            $name = explode('.', $name);
            $name[0]   =  strtoupper($name[0]);
            if (is_null($value))
                return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
            $_config[$name[0]][$name[1]] = $value;
            return null;
        }
        // 批量设置
        if (is_array($name)){
            $_config = array_merge($_config, array_change_key_case($name,CASE_UPPER));
            return null;
        }
        return null; // 避免非法参数
    }

    /**
     * 加载配置文件 支持格式转换 仅支持一级配置
     * @param string $file 配置文件名
     * @param string $parse 配置解析方法 有些格式需要用户自己解析
     * @return array
     */
    function load_config($file,$parse=''){
        $ext  = pathinfo($file,PATHINFO_EXTENSION);
        switch($ext){
            case 'php':
                return include $file;
            case 'ini':
                return parse_ini_file($file);
            case 'yaml':
                return yaml_parse_file($file);
            case 'xml':
                return (array)simplexml_load_file($file);
            case 'json':
                return json_decode(file_get_contents($file), true);
            default:
                if(function_exists($parse)){
                    return $parse($file);
                }else{
                    E(L('_NOT_SUPPORT_').':'.$ext);
                }
        }
    }

    function CC($name=null, $value=null){
        $conf = new \core\lib\conf();
        if($name == null){
            $conf->setConfig();
            return \core\lib\conf::$config;
        }

        $name = strtoupper($name);
        if(is_string($name)){
            if($value == null)
                return $conf->getConfig($name);
            else
                \core\lib\conf::$config[$name] = $value;
        }
        if(is_array($name)){
            \core\lib\conf::$config = array_merge(\core\lib\conf::$config, array_change_key_case($name,CASE_UPPER));
        }
    }


    //实例化数据库
    function M(){
        $model = new \core\lib\model\Model();
        return $model;
    }
    //实例化模型层
    function D($model){
        $model = '\\'. MODULE . '\\model\\' .$model.'Model';
        return new $model();
    }

/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}


/**
 * 实例化模型类 格式 [资源://][模块/]模型
 * @param string $name 资源地址
 * @param string $layer 模型层名称
 * @return Think\Model
 */
function D1($name='',$layer='') {
    if(empty($name)) return new Think\Model;
    static $_model  =   array();
    $layer          =   $layer? : C('DEFAULT_M_LAYER');
    if(isset($_model[$name.$layer]))
        return $_model[$name.$layer];
    $class          =   parse_res_name($name,$layer);
    if(class_exists($class)) {
        $model      =   new $class(basename($name));
    }elseif(false === strpos($name,'/')){
        // 自动加载公共模块下面的模型
        if(!C('APP_USE_NAMESPACE')){
            import('Common/'.$layer.'/'.$class);
        }else{
            $class      =   '\\Common\\'.$layer.'\\'.$name.$layer;
        }
        $model      =   class_exists($class)? new $class($name) : new Think\Model($name);
    }else {
        Think\Log::record('D方法实例化没找到模型类'.$class,Think\Log::NOTICE);
        $model      =   new Think\Model(basename($name));
    }
    $_model[$name.$layer]  =  $model;
    return $model;
}


/**
 * 实例化一个没有模型文件的Model
 * @param string $name Model名称 支持指定基础模型 例如 MongoModel:User
 * @param string $tablePrefix 表前缀
 * @param mixed $connection 数据库连接信息
 * @return Think\Model
 */
function M1($name='', $tablePrefix='',$connection='') {
    static $_model  = array();
    if(strpos($name,':')) {
        list($class,$name)    =  explode(':',$name);
    }else{
        $class      =   'Think\\Model';
    }
    $guid           =   (is_array($connection)?implode('',$connection):$connection).$tablePrefix . $name . '_' . $class;
    if (!isset($_model[$guid]))
        $_model[$guid] = new $class($name,$tablePrefix,$connection);
    return $_model[$guid];
}
//写入日志
function addLog($content=null,$path=null){
    return \core\lib\log::log($content,$path);
}
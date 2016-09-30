<?php
//定义项目目录

define('ROOT',__DIR__);
//定义框架目录
define('CORE',ROOT.DIRECTORY_SEPARATOR.'core/');
define('LIB',CORE.'lib/');
//定义项目入口
define('App',ROOT.DIRECTORY_SEPARATOR.'app/');
//定义控制器
define('Controller',"\\app\\controller\\");
define('VIEWS',App.'views/');
define('DEBUG',true);
include LIB.'autoload.php';
//加载comporse
include ROOT.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
//自动加载
spl_autoload_register("\\autoload::load");
//判断是何种方式启动的
if(!empty($_SERVER['SHELL'])){
    if(DEBUG){
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
    }
    \core\LPHP::shellRun();
}else{
    if(DEBUG){
        //打开错误提示
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
    \core\LPHP::run();
}






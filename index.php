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
if(DEBUG){
    ini_set('display_errors','On');
}else{
    ini_set('display_errors','Off');
}
include LIB.'autoload.php';
//加载comporse
include ROOT.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

//自动加载
spl_autoload_register("\\autoload::load");

//调用框架启动文件

\core\LPHP::run();



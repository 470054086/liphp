<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/12
 * Time: 14:12
 * Swoole启动文件
 */
define('ROOT',dirname(__DIR__));
define('SWOOLEROOT',__DIR__);
//定义框架目录
define('CORE',ROOT.DIRECTORY_SEPARATOR.'core/');
define('LIB',CORE.'lib/');

define('SWOOLE_FRAMWORK',CORE.'Swoole');
//定义项目入口
define('App',ROOT.DIRECTORY_SEPARATOR.'app/');
define('VIEWS',App.'views/');
//定义控制器
define('Controller',"\\app\\controller\\");


include LIB.'autoload.php';
//加载comporse
include ROOT.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

//自动加载
spl_autoload_register("\\autoload::load");

//打开错误
error_reporting(E_ALL);
ini_set('display_errors', '1');
//启动Swoole
\core\Swoole\Server::run();


<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/12
 * Time: 14:22
 */
namespace core\Swoole;
//swoole启动类
class Server{

    public static function run()
    {
        //解析启动参数
        Params::params();
        //自动创建响应的对象
        \core\Swoole\Network\Server::autoCreate(SWOOLE_FRAMWORK.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'swoole.ini');

    }
}
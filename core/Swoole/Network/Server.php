<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/12
 * Time: 15:01
 */
namespace core\Swoole\Network;
use core\Swoole\Params;

class Server
{
    //定义类型
    const HTTP_TYPE='HTTP';
    const TCP_TYPE='TCP';
    const SOCKET_TYPE='SOCKET';
    public static $sw;
    public static function autoCreate($file)
    {
        //解析配置文件
        if(empty($file)){
            throw new \Exception('不存在swoole配置文件');
        }
        $config=Params::paramsConfig($file);
        //检测是否有swoole扩展
        if (!class_exists('\\swoole_server', false))
        {
            exit('不存在swoole扩展');
        }
        //判断传递的启动类型
        $type=strtoupper(Params::$params['type']);
        switch($type){
            case self::TCP_TYPE:
                break;
            case self::SOCKET_TYPE:
                self::$sw=new \swoole_websocket_server($config['host'],$config['port']);
                break;
            case self::HTTP_TYPE:
                self::$sw=new \swoole_http_server($config['host'],$config['port']);
                break;
            default:
                throw new \Exception('没有你指定的类型');
                break;
        }
        //设置swoole属性
        self::$sw->set($config);
        //调用事件
        $event=new Event($type);
        self::$sw->start();
    }
}
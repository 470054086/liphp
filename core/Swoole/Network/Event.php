<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/13
 * Time: 16:27
 */
namespace core\Swoole\Network;
use core\Swoole\Params;
use core\Swoole\Network\Server;


class Event{
    public $protocol; //定义使用的协议
    public function __construct($type)
    {
        $this->protocol($type);
        Server::$sw->on('Start',[$this->protocol,'OnStart']);
        Server::$sw->on('ManagerStart',[$this->protocol,'onManagerStart']);
        Server::$sw->on('WorkerStart',[$this->protocol,'OnWorkStart']);
        Server::$sw->on('Shutdown',[$this->protocol,'onShutdown']);

        $config=Params::$configSwoole;
        //根据不同的类型  判断不同的事件
        if($type==Server::SOCKET_TYPE){
            Server::$sw->on('Open',[$this->protocol,'Onopen']);
            Server::$sw->on('Message',[$this->protocol,'OnMessage']);
            Server::$sw->on('Close',[$this->protocol,'onClose']);
        }elseif($type==Server::TCP_TYPE){

        }elseif($type==Server::HTTP_TYPE){
            Server::$sw->on('Request',[$this->protocol,'onRevicer']);
        }
        if(!empty($config['task_worker_num']) && $config['task_worker_num']>0){
            Server::$sw->on('Task',[$this->protocol,'OnTask']);
            Server::$sw->on('Finish',[$this->protocol,'OnFinish']);
        }
    }

    public function protocol($type)
    {
        $type=ucwords(strtolower($type)).'Swoole';
        $class ="\\core\\Swoole\\Network\\Swoole\\Adapter\\$type";
        $this->protocol=new $class();
    }


}
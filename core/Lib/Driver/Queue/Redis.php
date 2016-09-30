<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 10:46
 */
namespace core\Lib\Driver\Queue;

use core\Lib\Cache;
use core\Lib\Driver\QueueImplements;

class Redis implements QueueImplements{
    private $driver;
    private $queueName;
    private $queueObject;
    private $data=[];

    public function __construct()
    {
        $this->driver=Cache::getInstance();
    }
    /**
     * 输入队列的名字
     * @param $name
     * @return mixed
     */
    public function queue($name='defualt_queue')
    {
        $this->queueName=$name;
        return $this;
    }

    //将队列入队
    public function pushQueue($object)
    {
        //对数据进行解析  然后入队
        $this->data['queueObject']=$object;
        return $this;
    }

    public function delay($times)
    {
        // TODO: Implement delay() method.
        $this->data['delay']=$times+time();
        return $this;
    }

    public function enum($enum)
    {
        // TODO: Implement enum() method.
        $this->data['enum']=$enum;
        return $this;
    }

    /**
     * 对数据进行解析 然后入队
     */
    public function handle()
    {
        // TODO: Implement handle() method.
        $redis=\core\Lib\Redis::Instance();
        return $redis->lPush($this->queueName,serialize($this->data));
    }


}
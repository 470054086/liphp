<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 10:46
 */
namespace core\Lib\Driver\Log;
use core\Lib\Driver\LogImplements;

class Redis implements  LogImplements{
    private $name;
    public function __construct($name)
    {
        $this->name=$name;
        return $this;
    }
    public function inLog($content=[])
    {
        // TODO: Implement inLog() method.
        //将日志组合好结构写入redis
        $redis=new \Redis();
        $redis->connect('127.0.0.1');
        $redis->lpush($this->name,json_encode($content));
    }
}
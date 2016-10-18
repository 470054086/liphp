<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/17
 * Time: 15:56
 */
namespace app\Task;
class Index {

    public static function show($server,$data,$taskId,$fromId)
    {
    }

    public static function add($server,$data,$taskId,$fromId)
    {
        $redis=$server->Redis;
        $redis->lpush('history',$data);
    }

}
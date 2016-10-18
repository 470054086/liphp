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
        file_put_contents('a.log',json_encode($server->allConfig),FILE_APPEND);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 11:13
 */
namespace  core\Lib\Driver;
interface QueueImplements
{
    /**
     * 输入队列的名字
     * @param $name
     * @return mixed
     */
    public function queue($name='defualt_queue');

    /**
     * 延迟时间
     * @param $times
     * @return mixed
     */
    public function delay($times);

    /**
     * 错误次数
     * @param $enum
     * @return mixed
     */
    public function enum($enum);

    //将d对象入队
    public function pushQueue($object);

    public function handle();

}



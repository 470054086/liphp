<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 10:21
 * 事件消费者类
 */
namespace core\Tools;
interface Observer
{
    //事件执行的方法
    public function update($data=[]);
}
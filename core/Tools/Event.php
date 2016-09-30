<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 10:44
 * 执行一个事件类的方法
 */
namespace core\Tools;

use core\Lib\Config;

class Event{
    public static function fire(EventGenerator $event)
    {
        //获取类名
        $class=get_class($event);
        //判断配置文件中是否存在
        $observers=Config::getConfig('event.'.$class);
        foreach($observers as $observer) {
            $event->addObserver(new $observer);
        }
        $event->notify($event->data);
    }
}


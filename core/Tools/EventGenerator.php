<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 10:19
 * 事件产生器 类
 */
namespace core\Tools;
abstract class EventGenerator
{
    private $observer=[];
    //添加事件
    public function addObserver(Observer $observer)
    {
        $this->observer[]=$observer;
    }
    //执行事件
    public function notify($data=[])
    {
        if(!empty($this->observer)){
            foreach($this->observer as $observer)
            {
                $observer->update($data);
            }
        }
    }


}
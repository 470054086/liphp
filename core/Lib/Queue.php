<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/29
 * Time: 14:53
 * 队列文件
 *
 */
namespace core\Lib;


class Queue{
    private static $chanles=[];
    private static $chanler;

    //获取配置文件  实例化不同的驱动
    public static function getInstance($name='redis')
    {
        if(!empty(self::$chanles[$name])){
            return self::$chanles[$name];
        }else{
            $driver=empty(Config::getConfig('queue.driver'))?'redis':Config::getConfig('queue.driver');
            $driver=ucwords($driver);
            $file=LIB.'Driver'.DIRECTORY_SEPARATOR.'queue'.DIRECTORY_SEPARATOR.$driver.'.php';
            if(is_file($file)){
                $class="\\core\\Lib\\Driver\\Queue\\".$driver;
                //对这个类进行初始化
                self::$chanler=new $class($name);
                self::$chanles[$name]=self::$chanler;
                return self::$chanler;
            }else{
                throw new \Exception('加载的驱动文件'.$file.'不存在');
            }
        }

    }

}
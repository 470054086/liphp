<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 15:53
 */
namespace core;
use core\Lib\Route;

class LPHP{
    public static function run()
    {
        //调取 路由进行分发
        Route::dispatch();
    }

    public static function shellRun()
    {
        Route::Shelldispatch();
    }




    /**类的自动加载
     * @param $class
     */
    public static function load($class)
    {

    }

}

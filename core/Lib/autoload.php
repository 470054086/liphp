<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 15:56
 */
class autoload{
    //自动加载类
    private static $map=array();

    public static function load($class)
    {
        $class=str_replace('\\','/',$class);
        $fileName=ROOT.DIRECTORY_SEPARATOR.$class.'.php';
        //如果存在的话 则不进行加载
        if(!empty(self::$map[$class])){
            return true;
        }else{
            if(is_file($fileName)){
                include $fileName;
            }else{
                throw new Exception('加载的文件'.$fileName.'不存在');
            }
        }
    }
}
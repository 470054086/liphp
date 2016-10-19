<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 16:11
 */
namespace core\Lib;

class Route {
    private static $ctrl;
    private static $action;

    public static function dispatch($uris='',$request=null,$response=null)
    {
        $uris=!empty($uris)?$uris:$_SERVER['REQUEST_URI'];

        $urlsArr=explode('/',trim($uris,'/'));
        if(!empty($urlsArr[0])){
            self::$ctrl=ucwords($urlsArr[0]);
            unset($urlsArr[0]);
        }else{
            self::$ctrl=Config::getConfig('common.DEFAULT_CONTROLLER');
        }
        //对方法进行
        if(!empty($urlsArr[1])){
            self::$action=$urlsArr[1];
            unset($urlsArr[1]);
        }else{
            self::$action=\core\Lib\Config::getConfig('common.DEFAULT_ACTION');
        }
        $counts=count($urlsArr);
        $i=2;
        $tmp=[];
        while($i<=$counts){
            $tmp[$urlsArr[$i]]=$urlsArr[$i+1];
            $i=$i+2;
        }
        $_GET=$tmp;
        //进行控制器分发
        return self::ctrl($request,$response);
    }



    public static function Shelldispatch()
    {
        $urlsArr=$_SERVER['argv'];
        unset($urlsArr[0]);
        if(!empty($urlsArr[1])){
            self::$ctrl=ucwords($urlsArr[1]);
            unset($urlsArr[1]);
        }else{
            self::$ctrl=Config::getConfig('common.DEFAULT_CONTROLLER');//稍后使用配置文件替换掉
        }
        //对方法进行
        if(!empty($urlsArr[2])){
            self::$action=$urlsArr[2];
            unset($urlsArr[2]);
        }else{
            self::$action=\core\Lib\Config::getConfig('common.DEFAULT_ACTION');
        }
        $param=[];
        if(!empty($urlsArr)){
            foreach($urlsArr as $k=>$v)
            {
                $tmp=explode('=',$v);
                $param[$tmp[0]]=$tmp[1];
            }

        }
        $_GET=$param;
        //进行控制器分发
        self::ctrl();
    }

    public static function ctrl($request,$response)
    {
        $fileName=App.'controller'.DIRECTORY_SEPARATOR.self::$ctrl.'Controller.php';
        $new=Controller.self::$ctrl."Controller";
        $action=self::$action;
        if(is_file($fileName)){
            $ctr=new $new();
            return $ctr->$action($request,$response);
        }else{
            throw  new \Exception('你加载的控制器'.$fileName.'不存在');
        }
    }
}
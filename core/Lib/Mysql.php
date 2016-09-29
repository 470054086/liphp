<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 17:07
 */
namespace core\Lib;
class Mysql{
    private static $instance;
    final private function __construct()
    {
            $databaseConfig=Config::getConfigAll('database');
            self::$instance=new \medoo($databaseConfig);
    }

    /**
     * 数据库连接操作
     * @return \medoo
     */
    public static function Instance()
    {
        if(empty(self::$instance)){
            new self();
        }
        return self::$instance;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

}


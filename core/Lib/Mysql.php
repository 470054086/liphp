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

    }

    /**
     * 数据库连接操作
     * @return \medoo
     */
    public static function getInstance()
    {
        $databaseConfig=Config::getConfigAll('database');
        return new \medoo($databaseConfig);

    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

}


<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 11:36
 */
namespace core\Lib;
use Predis\Client;
class Redis
{
    public $redis;
    private static $instance;
    final private function __construct()
    {
        $RedisConfig=Config::getConfig('cache.Redis');
        $redisConfig=$RedisConfig['hosts'].":".$RedisConfig['port'];
        self::$instance=new Client($redisConfig);
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
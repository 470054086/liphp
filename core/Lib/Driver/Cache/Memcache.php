<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/29
 * Time: 11:44
 */
namespace core\Lib\Driver\Cache;
use core\Lib\Driver\CacheImplements;

class Redis implements CacheImplements{
    private $cache;
    public function __construct()
    {
        $config=Config::getConfig('cache.Memcache');
        $hosts=empty($config['hosts'])?'127.0.0.1':$config['hosts'];
        $port=empty($config['port'])?11211:$config['port'];
        $memcache = new Memcache();
        $memcache->connect($hosts,$port);
        $cacheDriver = new \Doctrine\Common\Cache\MemcacheCache();
        $cacheDriver->setMemcache($memcache);
        $cacheDriver->save('cache_id', 'my_data');
    }

    /**
     * 缓存写入
     * @param $name
     * @param $value
     * @param int $expire
     * @return bool
     */
    public function save($name,$value,$expire=0)
    {
        if(empty($value)){
            return false;
        }
        $this->cache->save($name,$value,$expire);
    }

    /**
     * 获取单个key
     * @param $name
     * @return false|mixed
     */
    public function get($name)
    {
        return $this->cache->fetch($name);
    }

    /**
     * 获取多个key
     * @param $name
     * @return array|\mixed[]
     */
    public function getAll($name)
    {
        if(!is_array($name)) return [];
        return $this->cache->fetchMultiple($name);
    }

    public function delete($name)
    {
        return $this->cache->delete($name);
    }

    public function deleteAll($name)
    {
        return $this->cache->deleteAll($name);
    }

    public function flush()
    {
        return $this->flush();
    }
}
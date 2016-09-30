<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 11:13
 */
namespace  core\Lib\Driver;
interface CacheImplements
{
    /**
     * 缓存写入
     * @param $name
     * @param $value
     * @param int $expire
     * @return bool
     */
    public function save($name,$value,$expire=0);

    /**
     * 获取单个key
     * @param $name
     * @return false|mixed
     */
    public function get($name);

    /**
     * 获取多个key
     * @param $name
     * @return array|\mixed[]
     */
    public function getAll($name);

    /**
     * 删除单个key
     * @param $name
     * @return mixed
     */
    public function delete($name);

    /**删除多个key
     * @param $name
     * @return mixed
     */
    public function deleteAll($name);

    /**
     * 清空整个库
     * @return mixed
     */
    public function flush();
}



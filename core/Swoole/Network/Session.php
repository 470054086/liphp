<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/20
 * Time: 10:28
 */
namespace core\Swoole\Network;

class Session{
        const SESSID_KEY='SESSID';
        public static function setsession($name,$value,$exp=900)
        {
                //注入 cookie 该cookie会和session关联
                $key=Cookie::getcookie(self::SESSID_KEY);
                if(empty($key)){
                     $key=Cookie::setcookie(self::SESSID_KEY,md5(uniqid()));
                }
                $data=[
                    $name=>$value
                ];
                $Cache= Server::$sw->Cache;
                $Cache->save($key,$data,$exp);
        }

        public static function getsession($name,$default='')
        {
                $key=Cookie::getcookie(self::SESSID_KEY);
                if(empty($key)) return $default;
                $redis= Server::$sw->Cache;
                $ret=$redis->get($key);
                if(empty($ret)) return $default;
                return $ret[$name];
        }
}
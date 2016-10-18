<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/17
 * Time: 14:08
 */
namespace core\Lib;
use core\Swoole\Network\Server;


class Common {
      public static function getInstance($name)
      {
          //这个是swoole的实例化
          if(!empty($_SERVER['argv'])){
                 return Server::$sw->$name;
           }else{
               //php-fpm 的实例化
               $class="\\core\\Lib\\{$name}";
               return $class::getInstance();
           }

      }
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/20
 * Time: 10:28
 */
namespace core\Swoole\Network;


class Cookie{

        public static function setcookie($name,$value,$exprie=0,$path = '/', $domain  = '', $secure = false,$httponly = false)
        {
                Server::$sw->response->cookie($name,$value,$exprie,$path,$domain,$secure,$httponly);
        }

        public static function getcookie($name='')
        {
                if(empty($name)){
                        return !empty(Server::$sw->request->cookie)?Server::$sw->request->cookie:'';
                }else{

                        return !empty(Server::$sw->request->cookie[$name])?Server::$sw->request->cookie[$name]:'';
                }
        }
}
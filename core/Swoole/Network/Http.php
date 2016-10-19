<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/19
 * Time: 14:58
 */
namespace core\Swoole\Network;
class Http{
    public $request;
    public $response;
    public function __construct($request,$resonse)
    {
        $this->response=$resonse;
        $this->request=$request;
    }

    public function setcookie($name,$value,$exprie,$path = '/', $domain  = '', $secure = false,$httponly = false)
    {
        $this->response->cookie($name,$value,$exprie,$path,$domain,$secure,$httponly);
    }

    public function getcookie($name='')
    {
        if(empty($name)){
            return $this->request->cookie;
        }else{
            return $this->request->cookie[$name];
        }
    }
    public function redirect($url,$status=302)
    {
        $this->response->header("Location",$url);
        $this->response->status($status);
        $this->response->end('location');
    }

    public function setsession($name,$value,$exp=900)
    {
        $key=$this->getcookie('SESSID');
        if(empty($key)){
            throw new \Exception('cookie SESSION  不存在');
        }
        $data=[
            $name=>$value
        ];
        $Cache= Server::$sw->Cache;
        $Cache->save($key,$data,$exp);
    }

    public function getsession($name,$default='')
    {
        $key=$this->getcookie('SESSID');
        if(empty($key)) return $default;
        $redis= Server::$sw->Cache;
        $ret=$redis->get($key);
        if(empty($ret)) return $default;
        return $ret[$name];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/13
 * Time: 10:42
 */
namespace core\Swoole\Network\Swoole\Adapter;
use core\Lib\Route;
use core\Swoole\Network\Swoole\BaseServer;

class SocketSwoole extends BaseServer{
        public function Onopen($ws, $request){
            $ret=['message'=>'系统消息:用户加入聊天室'];
            foreach($ws->connections as $fd)
            {
                $ws->push($fd,json_encode($ret));
            }
        }

        public function OnMessage($ws, $frame){
            $frame->data=json_decode($frame->data,true);
            $data=$frame->data;
            if(!empty($data['url'])){
                $ret=Route::dispatch($data['url'],$data['data']);
                foreach($ws->connections as $fd)
                {
                    $ws->push($fd,json_encode($ret));
                }

            }

        }

        public function onClose($ws, $fd){
            $ret=['message'=>'系统消息:用户:'.$fd."离开聊天室"];
            foreach($ws->connections as $fdwork)
            {
                if($fd!=$fdwork){
                    $ws->push($fdwork,json_encode($ret));
                }
            }
        }

}

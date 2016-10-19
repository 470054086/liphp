<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 16:25
 */
namespace app\controller;
use core\Lib\Common;
use core\Lib\Controller;
use core\Lib\Log;
use core\Swoole\Network\Http;
use core\Swoole\Network\Server;


class IndexController extends Controller
{
    public function __construct()
    {

    }

    public function index($request,$reponse)
    {
        $http=new Http($request,$reponse);
        $http->setsession('profile',[
            'name'=>'xiaobai',
            'age'=>100,
            'profile'=>'xxxx'
        ]);
        $this->display('index.html');
    }

    public function show()
    {
        $this->assign('name','xiaobai');
        return $this->display('show.html');
    }

    public function add($arg)
    {
        $data=[
            'name'=>'xiaobai',
            'message'=>$arg,
        ];
        $taskData=[
            'url'=>'Index/add',
            'data'=>$arg,
        ];
        Server::$sw->task($taskData);
        return $data;
    }



    public function loop()
    {
        /*
         * 循环将日志写入
         */
        if(empty($_SERVER['SHELL'])){
            return true;
        }

        $redis=new \Redis();
        $redis->connect('127.0.0.1');
        $queueName=empty($_GET['queue'])?'defualt_queue':$_GET['queue'];
        //去除最后一个
        $data=$redis->lRange($queueName,-1,-1);
        if(empty($data)){
            return true;
        }
        $data=unserialize($data[0]);
        if(!empty($data['delay'])){
            if($data['delay']>time()){
                return true;
            }
        }
        //执行方法
        try{
            $class=$data['queueObject'];
            $class->handle();
            Log::getInstance('queue')->inLog(['message'=>'队列执行成功']);
            $redis->lpop($queueName);
        }catch(\Exception $e){
            if($data['enum']==1){
                //直接写日志
                Log::getInstance('queue')->inLog($data);
            }else{
                $data['enum']=$data['enum'];
                $redis->rpush($queueName,serialize($data));
            }
        }
    }

}

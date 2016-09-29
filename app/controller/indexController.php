<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 16:25
 */
namespace app\controller;

use app\Model\PassportFanli;
use core\Lib\Cache;
use core\Lib\Config;
use core\Lib\Controller;
use core\Lib\Driver\Log\Redis;
use core\Lib\File;
use core\Lib\Log;
use core\Lib\Model;
use core\Lib\Queue;
use Sirius\Upload\Handler as Upload;

class IndexController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $queue=Queue::getInstance();

        $data=[
            'name'=>'xiaobai',
            'age'=>10
        ];
//        //将输入进入队列
//
        $queue->pushQueue(new \app\Jobs\Write($data))->delay(30)->enum(3)->queue('write')->handle();
        $this->assign('data',['name'=>'xiaobai','age'=>10]);
        $this->display('index.html');
    }


    public function loop()
    {
        /*
         * 循环将日志写入
         */
        set_time_limit(0);
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

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/13
 * Time: 15:56
 */
namespace core\Swoole\Network\Swoole;
use core\Lib\Route;
use core\Swoole\Network\Server;
use core\Swoole\Params;


abstract class BaseServer
{


    public function OnStart($serv)
    {
        $pid=$serv->master_pid;;
        $config=Params::$configSwoole;
        swoole_set_process_name("Swoole->Master pid {$pid},hosts->{$config['host']},port->{$config['port']}");
        //将pid写在文件中
        file_put_contents(Params::$pid_file,$pid);
    }

    public function onManagerStart($serv)
    {
        $pid=$serv->manager_pid;
        swoole_set_process_name("Swoole->Manage pid->{$pid}");
    }






    /**
     * 请求时间
     * 这是哪个傻逼写的代码
     * @param $server
     * @param $worker_id
     */
    public function OnWorkStart($serv,$worker_id)
    {
        $pid=$serv->worker_pid;
        if($worker_id >= $serv->setting['worker_num']) {
            swoole_set_process_name("Swoole->task_worker pid->{$pid}");
        } else {
            swoole_set_process_name("Swoole->worker pid->{$pid}");
        }
        //在这里对需要的对象进行实例化  并且存储在sw对象中  让全局都能使用
        //达到常驻内存
        $this->WorkStartMoudle();
    }

    public function WorkStartMoudle()
    {
        $config=Params::paramsModule(SWOOLE_FRAMWORK.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'swoole.ini');
        if(!empty($config['AUTOLOAD'])){
            unset($config['AUTOLOAD']);
            foreach($config as $k=>$v)
            {
                $cache=$v;
                $class="\\core\\Lib\\{$v}";
                Server::$sw->$cache=$class::getInstance();
            }
            //解析配置文件 并且保存在内存中
            $config=\core\Lib\Config::allConfig();
            Server::$sw->allConfig=$config;
        }
    }


    public function onRevicer($request,$response)
    {
        //过滤掉  request_uri  /favicon.ico
        if($request->server['request_uri']=='/favicon.ico'){
            return ;
        }
        //进行路由分发
        ob_start();
        Route::dispatch($request->server['request_uri']);
        $html=ob_get_contents();
        ob_end_clean();
        //设置头信息
        $response->header("Content-Type", "text/html; charset=utf-8");
        //输出最后的环境
        $response->end($html);
    }

    public function onTask($server, $taskId, $fromId, $data)
    {
        //固定格式 $data
        //url [url=>'task'] task类  task 方法
        if(empty($data['url'])){
            throw new \Exception('不存在url,不能找到对应的task类');
        }
        $urls=$data['url'];
        $params=explode('/',$urls);
        $config=$server->allConfig;
        $configModel=$config['task']['taks_model'];
        $class="{$configModel}{$params[0]}";
        $method=$params[1];
        $class::$method($server,$data['data'],$taskId,$fromId);
        return 'task Ok';
    }

    public function onFinish($server, $taskId, $data)
    {

    }



    /**
     * 这里是不是用ctrl+c 不会执行
     * @param $server
     */
    public function onShutdown($server)
    {
        unlink(Params::$pid_file);
    }

}
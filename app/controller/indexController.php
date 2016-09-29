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
use Sirius\Upload\Handler as Upload;

class IndexController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $cache=Cache::getInstance();
//        $cache->get('name');
        $cache->save('name',['name'=>'xiaobai','age'=>10],300);
//        var_dump($cache->get('name'));
        $this->assign('data',['name'=>'xiaobai','age'=>10]);
        $this->display('index.html');
    }


    public function upload()
    {


    }


    public function loop()
    {
        /*
         * 循环将日志写入
         */
        set_time_limit(0);
        $redis=new \Redis();
        $redis->connect('127.0.0.1');
        while(true){
            $info=$redis->lPop('server-log');
            if(empty($info)){
                sleep(10);
                continue;
            }
            File::writeLog('server-log-redis',$info);
        }
    }

}

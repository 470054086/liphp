<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/12
 * Time: 14:24
 */
namespace core\Swoole;
class Params{

    public static $params=[];
    public static $configSwoole=[];
    public static $pid_file;
    public static function params()
    {
        $opt = getopt('t:s:');
        self::$params['type'] = !empty($opt['t'])?$opt['t']:'http';
        //检测是否存在pid
        $pid_file=SWOOLEROOT.DIRECTORY_SEPARATOR.'pid'.DIRECTORY_SEPARATOR.self::$params['type'].'.pid';
        self::$pid_file=$pid_file;
        if(is_file($pid_file)){
            $server_pid=file_get_contents($pid_file);
        }else{
            $server_pid=0;
        }
        self::$params['server_pid']=$server_pid;
        //判断启动的选项
        if(empty($opt['s'])){
            goto usage;
        }elseif($opt['s']=='reload'){
            if(empty($server_pid)){
                exit('Swoole Server is not runing');
            }
            //进行刷新
            posix_kill($server_pid,SIGUSR1);
            echo "swoole is reload success\n";
            exit();
        }elseif($opt['s']=='start'){
            if(!empty($server_pid)){
                exit('Swoole Server is runing');
            }
        }elseif($opt['s']=='stop'){
            if(empty($server_pid)){
                exit('Swoole Server is not runing');
            }
            //杀死进程
            posix_kill($server_pid,SIGTERM);
            unlink($pid_file);
            echo "swoole is stop success\n";
            exit;
        }else{
            usage:
            echo "------------------------------------------------\n";
            echo "-usage:-t http|socket|tcp -s reoload|start|stop-\n";
            echo "-http                         创建一个http服务器-\n";
            echo "-socket                         创建一个websocket服务器-\n";
            echo "-tcp                         创建一个tcp服务器-\n";
            echo "-----------------------------------\n";
            exit();
        }
        return true;
    }

    /**
     * 解析swoole的配置文件
     * @param $file
     */
    public static function paramsConfig($file)
    {

        $config = parse_ini_file($file, true);
        $serverConfig=$config[strtoupper(self::$params['type'])];
        $commonConfig=$config['COMMON'];
        self::$configSwoole=array_merge($serverConfig,$commonConfig);
        return self::$configSwoole;
    }

    public static function paramsModule($file)
    {
        $config = parse_ini_file($file, true);
        $moudleConfig=$config['MOUDLE'];
        return $moudleConfig;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 11:28
 */
namespace core\Lib;
class File{
    public static function writeLog($file,$content)
    {
        //获取文件的路由
        $ConfigFile=Config::getConfig('log.file');
        $file=date('Y-m-d-').$file.'.'.$ConfigFile['extension'];
        $file=$ConfigFile['path'].$file;
        $dirName=dirname($file);
        //创建目录
        self::checkDir($dirName);
        $content='request times:'.date('Y-m-d H:i:s').'-->'.json_encode($content).PHP_EOL;
        //打开文件 写入记录
        file_put_contents($file,$content,FILE_APPEND);
    }

    /**
     * 检测文件的路径  如果不存在 则创建
     * @param $dir
     */
    public static function checkDir($dir)
    {
        return !is_dir($dir)?mkdir($dir,0755,true):true;
    }
}


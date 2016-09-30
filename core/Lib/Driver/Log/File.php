<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 10:46
 */
namespace core\Lib\Driver\Log;
use core\Lib\Driver\LogImplements;

class File implements  LogImplements{
    private $name;
    public function __construct($name)
    {
        $this->name=$name;
        return $this;
    }
    public function inLog($content=[])
    {
        // TODO: Implement inLog() method.
        //实现写日志的要求
        \core\Lib\File::writeLog($this->name,$content);
    }
}
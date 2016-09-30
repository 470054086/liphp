<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/29
 * Time: 15:05
 */
namespace app\Jobs;
use core\Lib\Log;

class Write{

    private $data;
    public function __construct($data)
    {
        $this->data=$data;
    }

    public function handle()
    {
        Log::getInstance('xiaobai')->inLog($this->data);
    }
}
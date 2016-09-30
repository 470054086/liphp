<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 10:37
 * 时间编程
 */
namespace app\Event;

use core\Tools\EventGenerator;

class UserRegisterEvent extends EventGenerator
{
    public  $data;
    public function __construct($data)
    {
        $this->data=$data;
    }
}
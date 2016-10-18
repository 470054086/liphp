<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/17
 * Time: 16:52
 */
namespace app\Task;
class Base {
    private static $_instance;
    public $server;
    public $taskId;
    public $fromId;

    final public function __construct($server,$data,$taskId,$fromId)
    {
        $this->fromId=$fromId;
        $this->server=$server;
        $this->fromId=$fromId;
    }

    public static function getInstance($server,$data,$taskId, $fromId)
    {
        if(empty(self::$_instance)){
            new self($server,$data,$taskId,$fromId);
        }
        


        return self::$_instance;

    }
}
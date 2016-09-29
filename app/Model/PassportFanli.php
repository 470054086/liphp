<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 16:07
 */
namespace app\Model;
use core\Lib\Model;

class PassportFanli extends Model{

     public function __construct()
     {
          parent::__construct();
          $this->databse=self::$instance;
     }

     public function getFanli()
     {
          $data=$this->lists();
          return $data;
     }

     public function getFanliOne($where)
     {
          return $this->getOne(['id'=>1]);
     }
     public function getPass()
     {
          return $this->databse->info();
     }
}
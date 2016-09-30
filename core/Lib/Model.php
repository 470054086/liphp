<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 15:51
 */
namespace core\Lib;
class Model{
     public $table;

    public function __construct()
    {
        //进行数据库连接
        $this->table=Mysql::Instance();
    }
    /**
     * 获取多条数据
     * @param $filters
     * @param $where
     * @return array
     */
    public function lists($where=[],$filters='*')
    {
        return $this->table->select($this->table,$filters,$where);
    }
    public function getOne($where=[],$filters='*')
    {
        return $this->table->get($this->table,$filters,$where);
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/27
 * Time: 16:49
 */
namespace core\Lib;
class Controller{
    //实现加载数据
    private $assign=[];
    public function assign($name,$value)
    {
        $this->assign[$name]=$value;
    }

    public function display($file)
    {
        if(strpos($file,'/')!==false)
        {
            $dir=explode('.',$file);
            $file=VIEWS.$dir[0].DIRECTORY_SEPARATOR.$dir[1];
        }else{
            $file=VIEWS.$file;
        }
        if(is_file($file)){
            extract($this->assign);
            include $file;
        }else{
            throw new \Exception('加载的模板'.$file.'不存在');
        }

    }
}
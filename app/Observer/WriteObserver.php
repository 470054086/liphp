<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 10:25
 */
namespace app\Observer;
class WriteObserver implements \core\Tools\Observer{
    public function update($data=[])
    {
        // TODO: Implement update() method.
        echo "写入日志".$data['age']."</br>";

    }
}
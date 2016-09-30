<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 10:25
 */
namespace app\Observer;
class UserObserver implements \core\Tools\Observer{
    public function update($data=[])
    {
        // TODO: Implement update() method.
        echo "更新了第一个".$data['age']."</br>";

    }
}
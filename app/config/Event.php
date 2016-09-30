<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/30
 * Time: 10:42
 */
return [
    'app\Event\UserRegisterEvent'=>[
        'app\Observer\CacheObserver',
        'app\Observer\UserObserver',
        'app\Observer\WriteObserver',
    ],

];
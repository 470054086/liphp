<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 10:47
 */
return [
    'driver'=>'file',
    'file'=>[
        'path'=>ROOT.DIRECTORY_SEPARATOR.'Logs'.DIRECTORY_SEPARATOR,
        'extension'=>'log',
    ],
    'redis'=>[
        'path'=>ROOT.DIRECTORY_SEPARATOR.'Logs'.DIRECTORY_SEPARATOR,
        'extension'=>'log',
    ]
];
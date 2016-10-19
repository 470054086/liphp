<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/18
 * Time: 17:50
 */
return [
    [
        'timeout'=>[
            'taskID'=>4,
            'name'=>'addPush',//线上的名称
            'desc'=>'每秒钟往redis中写入输入',//计划任务的描述
            'time'=>'16 * * * *',//根据crontab的计划任务
            'url'=>'Index/index',//执行的方法路径
            'argv'=>[
                'name'=>'xiaobai',
                'age'=>10,
            ]
        ],
        'intval'=>[
            'taskID'=>4,
            'name'=>'addPush',//线上的名称
            'desc'=>'每秒钟往redis中写入输入',//计划任务的描述
            'time'=>'16 * * * *',//根据crontab的计划任务
            'url'=>'Index/index',//执行的方法路径
            'argv'=>[
                'name'=>'xiaobai',
                'age'=>10,
            ]
        ]

    ]
];
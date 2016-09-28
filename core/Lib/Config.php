<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 10:05
 * 配置文件读取类
 */
namespace core\Lib;
class Config{
        private static $configArr=[];
        private static $config=[];
        /**获取配置文件的某个属性
         * @param $name
         * @param string $default
         * @return string
         * @throws \Exception
         */
        public static function getConfig($name,$default='')
        {
            self::parseConfig($name);
            if(!empty(self::$config[self::$configArr[0]])){
                return empty(self::$config[self::$configArr[0]][self::$configArr[1]])?$default:self::$config[self::$configArr[0]][self::$configArr[1]];
            }else{
                $file=App.'config'.DIRECTORY_SEPARATOR.self::$configArr[0].'.php';
                if(is_file($file)){
                    //如果加载过这个文件 则记录下来
                    $ret= include $file;
                    self::$config[self::$configArr[0]]=$ret;
                    return empty($ret[self::$configArr[1]])?$default:$ret[self::$configArr[1]];
                }else{
                    throw new \Exception('配置文件'.$file.'不存在');
                }
            }
        }

        /**获取这个文件的所有配置
         * @param $name
         */
        public static function getConfigAll($name)
        {
            if(!empty(self::$config[$name])){
                return self::$config[$name];
            }else{
                $file=App.'config'.DIRECTORY_SEPARATOR.$name.'.php';
                if(is_file($file)){
                    //如果加载过这个文件 则记录下来
                    $ret= include $file;
                    self::$config[$name]=$ret;
                    return empty($ret)?[]:$ret;
                }else{
                    throw new \Exception('配置文件'.$file.'不存在');
                }
            }
        }

        /**解析传递过来的配置文件
         * @param $name
         */
        private static function parseConfig($name)
        {
             if(strpos($name,'.')!==false)
             {
                  //解析成数组即可以
                  self::$configArr=explode('.',$name);
             }else{
                  self::$configArr[0]='common';
                  self::$configArr[1]=$name;
             }
        }



}
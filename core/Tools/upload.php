<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/28
 * Time: 17:55
 */
namespace core\Tools;


use core\Lib\Config;
use Sirius\Upload\Handler;
class Upload
{
    private $uploadFile;
    private $extension;
    private $size;
    public function __construct()
    {
          $this->uploadFile=Config::getConfig('upload.uploadPath');
          $this->extension=Config::getConfig('upload.extension');
          $this->size=Config::getConfig('upload.size');
    }

    public function Upload($name='picture',$upload='',$extentsion=[],$size='')
    {
        $uploadDir=empty($upload)?$this->uploadFile:$upload;
        $extentsion=empty($extentsion)?$this->extension:$extentsion;
        $size=empty($size)?$this->size:$size;
        $uploadHandler=new Handler($uploadDir);
        $uploadHandler->addRule('extension',['allowed' => $extentsion],'文件上传类型错误');
        $uploadHandler->addRule('size',['max' => $size],'文件上传大小错误');
        $result=$uploadHandler->process($_FILES[$name]);
//        if($result->isValid())
//        {
//            try {
//                $profile->picture = $result->name;
//                $profile->save();
//                $result->confirm(); // this will remove the .lock file
//            } catch (\Exception $e) {
//                // something wrong happened, we don't need the uploaded files anymore
//                $result->clear();
//                throw $e;
//            }
//        }
    }

}

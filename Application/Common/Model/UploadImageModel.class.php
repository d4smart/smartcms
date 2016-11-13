<?php
/**
 * 上传图片类
 * @author  singwa
 */

namespace Common\Model;
use Think\Model;

class UploadImageModel extends Model {
    // ThinkPHP文件上传类
    private $_uploadObj = '';
    // 文件上传路径
    const UPLOAD = 'upload';

    public function __construct() {
        $this->_uploadObj = new  \Think\Upload(); // 实例化文件上传类

        // 定义上传路径
        $this->_uploadObj->rootPath = './'.self::UPLOAD.'/';
        $this->_uploadObj->subName = date(Y) . '/' . date(m) .'/' . date(d);
    }

    /**
     * kindeditor的上传方法
     * @return string|bool 文件保存路径或失败
     */
    public function upload() {
        $res = $this->_uploadObj->upload();

        if($res) {
            return '/' .self::UPLOAD . '/' . $res['imgFile']['savepath'] . $res['imgFile']['savename'];
        } else {
            return false;
        }
    }

    /**
     * 使用ajax异步上传图片的图片上传方法
     * @return string|bool 文件保存路径或失败
     */
    public function imageUpload() {
        $res = $this->_uploadObj->upload();

        if($res) {
            return '/' .self::UPLOAD . '/' . $res['file']['savepath'] . $res['file']['savename'];
        } else {
            return false;
        }
    }
}

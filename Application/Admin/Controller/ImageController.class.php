<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/28
 * Time: 12:04
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;

class ImageController extends CommonController
{
    private $_uploadObj;

    public function __construct() {
        parent::__construct();
    }

    public function ajaxuploadimage() {
        $upload = D("UploadImage");
        $res = $upload->imageUpload();

        if ($res === false) {
            return show(0, "上传失败！", '');
        } else {
            return show(1, "上传成功！", $res);
        }
    }

    public function kindupload() {
        $upload = D("UploadImage");
        $res = $upload->upload();

        if ($res === false) {
            return showKind(0, "上传失败！");
        } else {
            return showKind(1, $res);
        }
    }
}
<?php
/**
 * Desp: 处理图片上传的控制器
 * User: d4smart
 * Date: 2016/10/28
 * Time: 12:04
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;

class ImageController extends CommonController
{
    /**
     * 图片异步上传方法
     * 上传图片，返回图片的存储路径或失败信息
     */
    public function ajaxuploadimage() {
        $upload = D("UploadImage");
        $res = $upload->imageUpload();

        if ($res === false) {
            exit(show(0, "上传失败！", ''));
        } else {
            exit(show(1, "上传成功！", $res));
        }
    }

    /**
     * 文件异步上传方法
     * 上传文件，返回文件的存储路径或失败信息
     */
    public function kindupload() {
        $upload = D("UploadImage");
        $res = $upload->upload();

        if ($res === false) {
            exit(showKind(0, "上传失败！"));
        } else {
            exit(showKind(1, $res));
        }
    }
}
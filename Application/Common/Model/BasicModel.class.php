<?php
/**
 * Desp: 网站基本配置模型
 * User: d4smart
 * Date: 2016/11/1
 * Time: 19:26
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class BasicModel extends Model
{
    public function __construct() {

    }

    public function save($data = array()) {
        if (!$data) {
            throw_exception("没有提交的数据！");
        }
        $id = F('basic_web_config', $data);
        return $id;
    }

    public function select() {
        return F('basic_web_config');
    }
}
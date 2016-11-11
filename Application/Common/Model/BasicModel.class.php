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
        // 重写父类的construct方法，避免因为模型不对应数据库产生的bug
    }

    public function save($data = array()) {
        return F('basic_web_config', $data);
    }

    public function select() {
        return F('basic_web_config');
    }
}
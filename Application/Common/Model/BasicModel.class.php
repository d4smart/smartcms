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

    /**
     * 保存网站的配置信息（使用框架提供的F()方法）
     * @param array $data 网站配置信息
     * @return bool 缓存是否成功
     */
    public function save($data = array()) {
        return F('basic_web_config', $data);
    }

    /**
     * 获取缓存的网站配置信息
     * @return array 网站配置信息
     */
    public function select() {
        return F('basic_web_config');
    }
}
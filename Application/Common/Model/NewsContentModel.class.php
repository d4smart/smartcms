<?php
/**
 * Desp: 新闻内容模型
 * User: d4smart
 * Date: 2016/10/28
 * Time: 14:03
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class NewsContentModel extends Model
{
    // 静态自动完成规则
    protected $_auto = array(
        array('create_time', 'time', 1, 'function'), // 创建时更新创建时间
        array('update_time', 'time', 3, 'function'), // 更新时更新更新时间
    );

    // 静态验证规则
    protected $_validate = array(
        array('content', 'require', '文章内容不得为空！', 1, 'regex', 1),
    );

}
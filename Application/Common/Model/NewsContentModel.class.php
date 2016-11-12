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
    protected $_auto = array(
        array('create_time', 'time', 1, 'function'),
        array('update_time', 'time', 3, 'function'),
    );

    protected $_validate = array(
        array('content', 'require', '文章内容不得为空！', 1, 'regex', 1),
    );

}
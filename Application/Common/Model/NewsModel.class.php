<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/28
 * Time: 13:50
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class NewsModel extends Model
{
    private $_db = '';

    public function __construct() {
        $this->_db = M('news');
    }

    public function insert($data=array()) {
        if (!is_array($data) || !$data) {
            return 0;
        }

        $data['username'] = getLoginUsername();
        $data['create_time'] = time();
        return $this->_db->add($data);
    }
}
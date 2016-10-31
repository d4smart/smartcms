<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/31
 * Time: 11:12
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class PositionContentModel extends Model
{
    private $_db = '';

    public function __construct() {
        parent::__construct();
        $this->_db = M('position_content');
    }

    public function insert($data=array()) {
        if (!is_array($data) || !$data) {
            return 0;
        }

        return $this->_db->add($data);
    }
}
<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/25
 * Time: 18:39
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class AdminModel extends Model
{
    private $_db = '';

    public function __construct() {
        $this->_db = M('admin');
    }

    public function getAdminByUsername($username) {
        $ret = $this->_db->where(array('username'=>$username))->find();
        return $ret;
    }
}
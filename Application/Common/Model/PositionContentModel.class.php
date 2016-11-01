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

    public function select($data = array(), $limit = 0) {
        if ($data['title']) {
            $data['title'] = array('like', '%'.$data['title'].'%');
        }
        $this->_db->where($data)->order('listorder desc, id desc');
        if ($limit) {
            $this->_db->limit($limit);
        }
        $list = $this->_db->select();
        return $list;
    }

    public function insert($data=array()) {
        if (!is_array($data) || !$data) {
            return 0;
        }

        return $this->_db->add($data);
    }

    public function updateById($id, $data) {
        if (!$id || !is_numeric($id)) {
            throw_exception("ID不合法！");
        }
        if (!$data || !is_array($data)) {
            throw_exception("更新的数据不合法！");
        }

        return $this->_db->where('id='.$id)->save($data);
    }

    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception("status不能为非数字！");
        }
        if (!$id || !is_numeric($id)) {
            throw_exception("id不合法！");
        }

        $data['status'] = $status;
        return $this->_db->where('id='.$id)->save($data);
    }
}
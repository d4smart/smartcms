<?php
/**
 * Desp: 推荐为管理操作
 * User: d4smart
 * Date: 2016/10/31
 * Time: 9:28
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class PositionModel extends Model
{
    private $_db = '';

    public function __construct() {
        parent::__construct();
        $this->_db = M("position");
    }

    public function select($data = array()) {
        $conditions = $data;
        $list = $this->_db->where($conditions)->order('id')->select();
        return $list;
    }

    public function find($id) {
        return $this->_db->find($id);
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

    /**
     * 获取正常的推荐为内容
     * @return mixed
     */
    public function getNormalPositions() {
        $conditions = array('status'=>1);
        $list = $this->_db->where($conditions)->order('id')->select();
        return $list;
    }

    public function getCount($data=array()) {
        $conditions = $data;
        $list = $this->_db->where($conditions)->count();

        return $list;
    }
}
<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/26
 * Time: 14:30
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Common\Model;
use Think\Model;

class MenuModel extends Model
{
    private $_db = '';

    public function __construct() {
        $this->_db = M('menu');
    }

    public function insert($data = array()) {
        if (!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }

    public function getMenus($data, $page, $pageSize=10) {
        $data['status'] = array('neq', -1);
        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($data)->order('listorder desc, menu_id')->limit($offset, $pageSize)->select();
        return $list;
    }

    public function getMenusCount($data=array()) {
        $data['status'] = array('neq', -1);
        return $this->_db->where($data)->count();
    }

    public function find($id) {
        if (!$id || !is_numeric($id)) {
            return array();
        }
        return $this->_db->find($id);
    }

    public function updateMenuById($id, $data) {
        if (!$id || !is_numeric($id)) {
            throw_exception("ID不合法！");
        }
        if (!$data || !is_array($data)) {
            throw_exception("更新的数据不合法！");
        }

        return $this->_db->where('menu_id='.$id)->save($data);
    }

    public function updateStatusById($id, $status) {
        if (!is_numeric($id) || !$id) {
            throw_exception("ID不合法！");
        }
        if (!is_numeric($status)) {
            throw_exception("状态不合法！");
        }

        $data['status'] = $status;
        return $this->_db->where('menu_id='.$id)->save($data);
    }

    public function updateListorderById($id, $listorder) {
        if (!$id || !is_numeric($id)) {
            throw_exception("ID不合法！");
        }

        $data = array('listorder' => intval($listorder));
        return $this->_db->where('menu_id='.$id)->save($data);
    }

    public function getAdminMenus() {
        $data = array(
            'status' => array('neq', -1),
            'type' => 1,
        );

        return $this->_db->where($data)->order('listorder desc, menu_id')->select();
    }

    public function getBarMenus() {
        $data = array(
            'type' => 0,
            'status' => 1,
        );

        $res = $this->_db->where($data)
                ->order('listorder desc, menu_id')
                ->select();
        return $res;
    }

}
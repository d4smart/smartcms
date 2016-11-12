<?php
/**
 * Desp: 菜单模型
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
    private $menu = '';

    protected $_auto = array(
        array('listorder', '0'),
    );

    protected $_validate = array(
        array('name', 'require', '菜单名不得为空！', 1, 'regex', 3),
        array('m', 'require', '模块名不得为空！', 1, 'regex', 3),
        array('c', 'require', '控制器不得为空！', 1, 'regex', 3),
        array('f', 'require', '方法不得为空！', 1, 'regex', 3),
        array('status', 'require', '菜单状态不得为空！', 1, 'regex', 3),
        array('type', 'require', '菜单类型不得为空！', 1, 'regex', 3),
    );

    public function __construct() {
        parent::__construct();
        $this->menu = M('menu');
    }

    public function getMenus($data, $page, $pageSize=10) {
        $data['status'] = array('neq', -1);
        $offset = ($page - 1) * $pageSize;
        $list = $this->menu->where($data)->order('listorder desc, menu_id')->limit($offset, $pageSize)->select();
        return $list;
    }

    public function getMenusCount($data=array()) {
        $data['status'] = array('neq', -1);
        return $this->menu->where($data)->count();
    }

    public function updateStatusById($id, $status) {
        return $this->menu->where(array('menu_id' => $id))->setField('status', $status);
    }

    public function updateListorderById($id, $listorder) {
        return $this->menu->where(array('menu_id' => $id))->setField('listorder', $listorder);
    }

    public function getAdminMenus() {
        $data = array(
            'status' => array('neq', -1),
            'type' => 1, // 后台模块
        );

        return $this->menu->where($data)->order('listorder desc, menu_id')->select();
    }

    public function getBarMenus() {
        $data = array(
            'type' => 0, // 前台模块
            'status' => 1,
        );

        return $this->menu->where($data)->order('listorder desc, menu_id')->select();
    }

}
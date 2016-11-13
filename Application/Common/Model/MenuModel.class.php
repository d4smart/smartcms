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
    // 数据库实例
    private $menu = '';

    // 静态自动完成规则
    protected $_auto = array(
        array('listorder', '0'),
    );

    // 静态自动验证规则
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

    /**
     * 根据传入的条件和页码[每页条数]获取菜单数据
     * @param array $data 查询条件
     * @param int $page 页码
     * @param int $pageSize 每页显示条数
     * @return array 菜单数据
     */
    public function getMenus($data, $page, $pageSize=10) {
        $data['status'] = array('neq', -1);
        $offset = ($page - 1) * $pageSize;
        $list = $this->menu->where($data)->order('listorder desc, menu_id')->limit($offset, $pageSize)->select();
        return $list;
    }

    /**
     * 获取满足条件的菜单数
     * @param array $data 查询条件
     * @return int 菜单数
     */
    public function getMenusCount($data=array()) {
        $data['status'] = array('neq', -1);
        return $this->menu->where($data)->count();
    }

    /**
     * 通过id更新菜单状态
     * @param int $id 菜单id
     * @param int $status
     * @return bool 更新是否成功
     */
    public function updateStatusById($id, $status) {
        return $this->menu->where(array('menu_id' => $id))->setField('status', $status);
    }

    /**
     * 根据id更新菜单排序
     * @param int $id 菜单id
     * @param int $listorder 菜单排序数
     * @return bool 排序是否成功
     */
    public function updateListorderById($id, $listorder) {
        return $this->menu->where(array('menu_id' => $id))->setField('listorder', $listorder);
    }

    /**
     * 获取状态不为关闭的后台菜单
     * @return array 后台菜单数据
     */
    public function getAdminMenus() {
        $data = array(
            'status' => array('neq', -1),
            'type' => 1, // 后台模块
        );
        return $this->menu->where($data)->order('listorder desc, menu_id')->select();
    }

    /**
     * 获取状态为开启的前台菜单
     * @return array 前台菜单数据
     */
    public function getBarMenus() {
        $data = array(
            'type' => 0, // 前台模块
            'status' => 1,
        );
        return $this->menu->where($data)->order('listorder desc, menu_id')->select();
    }

}
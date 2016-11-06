<?php
/**
 * Desp: 菜单控制器
 * User: d4smart
 * Date: 2016/10/26
 * Time: 10:29
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Exception;

class MenuController extends CommonController
{
    public function index() {
        $data = array();

        if (isset($_REQUEST['type']) && in_array($_REQUEST['type'], array(0, 1))) {
            $data['type'] = intval($_REQUEST['type']);
            $this->assign('type', $data['type']);
        } else {
            $this->assign('type', -1);
        }

        /**
         * 分页操作逻辑
         */
        $page = $_REQUEST['p']?$_REQUEST['p']:1;
        $pageSize = $_REQUEST['pageSize']?$_REQUEST['pageSize']:10;
        $menus = D('Menu')->getMenus($data, $page, $pageSize);
        $menusCount = D('Menu')->getMenusCount($data);
        $res = new \Think\Page($menusCount, $pageSize);
        $pageRes = $res->show();

        $this->assign('pageRes', $pageRes);
        $this->assign('menus', $menus);
        $this->display();
    }

    public function add() {
        if ($_POST) {
            if (!isset($_POST['name']) || !$_POST['name']) {
                return show(0, "菜单名不能为空！");
            }
            if (!isset($_POST['m']) || !$_POST['m']) {
                return show(0, "模块名不能为空！");
            }
            if (!isset($_POST['c']) || !$_POST['c']) {
                return show(0, "控制器不能为空！");
            }
            if (!isset($_POST['f']) || !$_POST['f']) {
                return show(0, "方法名不能为空！");
            }

            if (I('menu_id')) {
                return $this->save($_POST);
            }

            $menuId = D("Menu")->insert($_POST);
            if ($menuId) {
                return show(1, "新增成功！", $menuId);
            }
            return show(0, "新增失败！");

        } else {
            $this->display();
        }
    }

    public function edit() {
        $menuId = I('id');
        $menu = D("Menu")->find($menuId);
        $this->assign("menu", $menu);

        $this->display();
    }

    public function save($data) {
        $menuId = $data['menu_id'];
        unset($data['menu_id']);

        try {
            $id = D("Menu")->updateMenuById($menuId, $data);
            if ($id === false) {
                return show(0, "更新失败！");
            }
            return show(1, "更新成功！");
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function setStatus() {
        $data = array(
            'id' => intval(I('id')),
            'status' => intval(I('status')),
        );
        return parent::setStatus($data, "Menu");
    }

    public function listorder() {
        return parent::listorder("Menu");
    }
}
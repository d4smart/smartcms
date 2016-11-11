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
            $data['type'] = $_REQUEST['type'];
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
            if (I('menu_id')) {
                return $this->save();
            }

            $menu = D('Menu');
            if ($menu->create($_POST)) {
                if ($menu->add()) {
                    return show(1, "新增成功！");
                } else {
                    return show(0, "新增失败！");
                }
            } else {
                return show(0, $menu->getError());
            }
        }

        $this->display();
    }

    public function edit() {
        $menuId = I('id');
        $menu = D("Menu")->find($menuId);
        $this->assign("menu", $menu);

        $this->display();
    }

    public function save() {
        $menu = D('Menu');
        if ($menu->create($_POST)) {
            if ($menu->save()) {
                return show(1, "更新成功！");
            } else {
                return show(0, "更新失败！");
            }
        } else {
            return show(0, $menu->getError());
        }
    }

    public function setStatus() {
        $news = D('Menu');
        $res = $news->updateStatusById(I('id'), I('status'));
        if ($res) {
            return show(1, "操作成功！");
        } else {
            return show(0, "操作失败！");
        }
    }

    public function listorder() {
        return parent::listorder("Menu");
    }
}
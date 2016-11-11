<?php
/**
 * Desp: 推荐位控制器
 * User: d4smart
 * Date: 2016/10/31
 * Time: 9:58
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Exception;

class PositionController extends CommonController
{
    public function index() {
        $positions = D("Position")->getNormalPositions();

        $this->assign('positions', $positions);
        $this->display();
    }

    public function add() {
        if ($_POST) {
            if (I('id')) {
                return $this->save();
            }

            $position = D('Position');
            $_POST['create_time'] = time();
            $_POST['update_time'] = time();

            if ($position->create($_POST)) {
                if ($position->add()) {
                    return show(1, "新增成功！");
                } else {
                    return show(0, "新增失败！");
                }
            } else {
                return show(0, $position->getError());
            }
        } else {
            // 显示推荐位位置添加页面
            $this->display();
        }
    }

    public function edit() {
        $id = I('id');
        $vo = D("Position")->find(intval($id));
        $this->assign('vo', $vo);

        $this->display();
    }

    public function save() {
        $position = D('Position');
        $_POST['update_time'] = time();
        if ($position->create($_POST)) {
            if ($position->save()) {
                return show(1, "更新成功！");
            } else {
                return show(0, "更新失败！");
            }
        } else {
            return show(0, $position->getError());
        }
    }

    public function setStatus() {
        $position = D('Position');
        $res = $position->updateStatusById(I('id'), I('status'));
        if ($res) {
            return show(1, "操作成功！");
        } else {
            return show(0, "操作失败！");
        }
    }
}
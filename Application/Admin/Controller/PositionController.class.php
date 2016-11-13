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
    /**
     * 后台推荐位首页
     */
    public function index() {
        $positions = D("Position")->getNormalPositions();

        $this->assign('positions', $positions);
        $this->display();
    }

    /**
     * 推荐位添加
     * 如果有post数据，就添加推荐位数据，并返回状态信息；否则显示推荐位添加页面
     */
    public function add() {
        if ($_POST) {
            if (I('id')) {
                return $this->save();
            }

            $position = D('Position');

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

    /**
     * 推荐位编辑页面
     */
    public function edit() {
        $id = I('id');
        $vo = D("Position")->find(intval($id));
        $this->assign('vo', $vo);

        $this->display();
    }

    /**
     * 推荐位保存函数
     * 保存post过来的推荐位信息
     */
    public function save() {
        $position = D('Position');

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

    /**
     * 推荐位状态设置函数
     * 设置推荐位的状态，并返回状态信息
     */
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
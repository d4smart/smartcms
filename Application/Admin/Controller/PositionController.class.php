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
            if (!isset($_POST['name']) || !$_POST['name']) {
                return show(0, "推荐位名称不能为空！");
            }

            if (I('id')) {
                $_POST['update_time'] = time();
                $res = D("Position")->save($_POST);
                if ($res === false) {
                    return show(0, "更新失败！");
                }
                return show(1, "更新成功！");
            }

            try {
                $_POST['create_time'] = time();
                $_POST['update_time'] = time();
                $id = D("Position")->add($_POST);
                if ($id) {
                    return show(1, "新增成功！");
                } else {
                    return show(0, "新增失败！");
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $this->display();
        }
    }

    public function edit() {
        $id = I('id');
        $vo = D("Position")->find(intval($id));
        $this->assign('vo', $vo);

        $this->display();
    }
}
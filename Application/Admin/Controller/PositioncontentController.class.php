<?php
/**
 * Desp: 推荐位内容控制器
 * User: d4smart
 * Date: 2016/10/31
 * Time: 12:36
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Exception;

class PositioncontentController extends CommonController
{
    public function index() {
        $positions = D("Position")->getNormalPositions();
        // 获取推荐位内容
        $data['status'] = array('neq', -1);
        if (I('title')) {
            $data['title'] = trim(I('title'));
            $this->assign('title', $data['title']);
        }
        $data['position_id'] = I('position_id') ? intval(I('position_id')) : $positions[0]['id'];
        $contents = D("PositionContent")->select($data);

        $this->assign('contents', $contents);
        $this->assign('positions', $positions);
        $this->assign('positionId', $data['position_id']);
        $this->display();
    }

    public function add() {
        if ($_POST) {
            if (!isset($_POST['position_id']) || !$_POST['position_id']) {
                return show(0, "推荐位ID不能为空！");
            }
            if (!isset($_POST['title']) || !$_POST['title']) {
                return show(0, "推荐位标题不能为空！");
            }
            if (!I('url') && !I('news_id')) {
                return show(0, "url和news_id不能同时为空！");
            }
            if (I('id')) {
                return $this->save($_POST);
            }

            if (!isset($_POST['thumb']) || !I('thumb')) {
                if (I('news_id')) {
                    $res = D('News')->find(intval(I('news_id')));
                    if ($res && is_array($res)) {
                        $_POST['thumb'] = $res['thumb'];
                    }
                } else {
                    return show(0, "图片不能为空！");
                }
            }

            try {
                $_POST['create_time'] = time();
                $_POST['update_time'] = time();
                $id = D("PositionContent")->insert($_POST);
                if ($id) {
                    return show(1, "新增成功！");
                } else {
                    return show(0, "新增失败！");
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
        } else {
            $positions = D("Position")->getNormalPositions();
            $this->assign('positions', $positions);
            $this->display();
        }
    }

    public function edit() {
        $id = I('id');
        $position = D("PositionContent")->find(intval($id));
        $positions = D("Position")->getNormalPositions();

        $this->assign('vo', $position);
        $this->assign('positions', $positions);
        $this->display();
    }

    public function save() {
        $id = intval(I('id'));
        unset($_POST['id']);
        $_POST['update_time'] = time();

        // 继续使用文章的缩略图
        if ($_POST['news_id']) {
            $res = D('News')->find(intval(I('news_id')));
            if ($res && is_array($res)) {
                $_POST['thumb'] = $res['thumb'];
            }
        }

        try {
            $resId = D("PositionContent")->updateById($id, $_POST);
            if ($resId === false) {
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
        return parent::setStatus($data, "PositionContent");
    }

    public function listorder() {
        return parent::listorder("PositionContent");
    }
}
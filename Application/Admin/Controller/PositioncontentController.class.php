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
            if (!I('url') && !I('news_id')) {
                return show(0, "url和news_id不能同时为空！");
            }
            if (I('id')) {
                return $this->save();
            }

            if (!isset($_POST['thumb']) || !I('thumb')) {
                if (I('news_id')) {
                    $res = D('News')->find(I('news_id'));
                    if ($res && is_array($res)) {
                        $_POST['thumb'] = $res['thumb'];
                    }
                } else {
                    return show(0, "图片不能为空！");
                }
            }

            $positionContent = D('PositionContent');
            if ($positionContent->create($_POST)) {
                if ($positionContent->add()) {
                    return show(1, "新增成功！");
                } else {
                    return show(0, "新增失败！");
                }
            } else {
                return show(0, $positionContent->getError());
            }
        } else {
            // 渲染添加页面
            $positions = D("Position")->getNormalPositions();
            $this->assign('positions', $positions);
            $this->display();
        }
    }

    public function edit() {
        $id = I('id');
        $position = D("PositionContent")->find($id);
        $positions = D("Position")->getNormalPositions();

        $this->assign('vo', $position);
        $this->assign('positions', $positions);
        $this->display();
    }

    public function save() {
        $positionContent = D('PositionContent');

        // 继续使用文章的缩略图
        if ($_POST['news_id']) {
            $res = D('News')->find(I('news_id'));
            if ($res && is_array($res)) {
                $_POST['thumb'] = $res['thumb'];
            }
        }

        if ($positionContent->create($_POST)) {
            if ($positionContent->save()) {
                return show(1, "更新成功！");
            } else {
                return show(0, "更新失败！");
            }
        } else {
            return show(0, $positionContent->getError());
        }
    }

    public function setStatus() {
        $news = D('PositionContent');
        $res = $news->updateStatusById(I('id'), I('status'));
        if ($res) {
            return show(1, "操作成功！");
        } else {
            return show(0, "操作失败！");
        }
    }

    public function listorder() {
        return parent::listorder("PositionContent");
    }
}
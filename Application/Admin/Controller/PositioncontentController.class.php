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
    /**
     * 推荐位内容首页
     * 根据传入的查询条件显示推荐位内容信息
     */
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

    /**
     * 推荐位内容添加方法
     * 如果有post数据，就对推荐位内容数据进行合法性检查，并将推荐位内容添加到数据库；否则显示推荐位内容添加页面
     */
    public function add() {
        if ($_POST) {
            // 数据合法性检查
            if (!I('url') && !I('news_id')) {
                return show(0, "url和news_id不能同时为空！");
            }
            if (I('id')) {
                return $this->save();
            }

            // 缩略图的特殊处理
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

    /**
     * 推荐位内容编辑页面
     * 显示推荐位内容编辑页面
     */
    public function edit() {
        $id = I('id');
        $position = D("PositionContent")->find($id);
        $positions = D("Position")->getNormalPositions();

        $this->assign('vo', $position);
        $this->assign('positions', $positions);
        $this->display();
    }

    /**
     * 推荐位内容保存函数
     * 保存post过来的文章数据
     */
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

    /**
     * 推荐位内容编辑页面状态设置方法
     * 设置推荐位内容编辑页面的状态，并返回状态信息
     */
    public function setStatus() {
        $news = D('PositionContent');
        $res = $news->updateStatusById(I('id'), I('status'));
        if ($res) {
            return show(1, "操作成功！");
        } else {
            return show(0, "操作失败！");
        }
    }

    /**
     * 推荐位内容编辑页面排序方法
     * 调用父类的公共方法
     */
    public function listorder() {
        return parent::listorder("PositionContent");
    }
}
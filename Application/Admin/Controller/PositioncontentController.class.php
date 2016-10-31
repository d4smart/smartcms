<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/31
 * Time: 12:36
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

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
        $this->display();
    }
}
<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/31
 * Time: 9:58
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

class PositionController extends CommonController
{
    public function index() {
        $data = array();

        $positions = D("Position")->getNormalPositions();

        $this->assign('positions', $positions);
        $this->display();
    }

    public function add() {
        $this->display();
    }

    public function edit() {
        $this->display();
    }
}
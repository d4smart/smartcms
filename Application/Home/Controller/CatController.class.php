<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/11/3
 * Time: 10:16
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;
use Think\Controller;

class CatController extends CommonController
{
    public function index() {
        $id = intval(I('id'));
        if (!$id) {
            return $this->error('ID不存在！');
        }

        $nav = D("Menu")->find($id);
        if (!$nav || $nav['status'] != 1) {
            return $this->error("栏目ID不存在！/栏目状态不正常！");
        }

        // 获取文章排行
        $rankNews = $this->getRank();
        // 广告位数据
        $advNews = D("PositionContent")->select(array('status'=>1, 'position_id'=>3), 3);

        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 20;
        $conds = array(
            'status' => 1,
            'thumb' => array('neq', ''),
            'catid' => $id,
        );
        $news = D("News")->getNews($conds, $page, $pageSize);
        $count = D("News")->getNewsCount($conds);

        $res = new \Think\Page($count, $pageSize);
        $pageres = $res->show();

        $this->assign('result', array(
            'advNews' => $advNews,
            'rankNews' => $rankNews,
            'catid' => $id,
            'listNews' => $news,
            'pageres' => $pageres,
        ));
        $this->display();
    }
}
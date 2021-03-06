<?php
/**
 * Desp: 首页分类控制器
 * User: d4smart
 * Date: 2016/11/3
 * Time: 10:16
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;

class CatController extends CommonController
{
    /**
     * 栏目页面控制器
     * 根据传入的栏目id分页展示文章数据
     */
    public function index() {
        $id = I('id');
        if (!$id) {
            return $this->error('ID不存在！');
        }

        $nav = D("Menu")->find($id);
        if (!$nav || $nav['status'] != 1) {
            return $this->error("栏目ID不存在或栏目状态不正常");
        }

        // 分页展示
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 20;
        $conditions = array(
            'status' => 1,
            'thumb' => array('neq', ''),
            'catid' => $id,
        );
        $news = D("News")->getNews($conditions, $page, $pageSize);
        $count = D("News")->getNewsCount($conditions);

        $res = new \Think\Page($count, $pageSize);
        $pageres = $res->show();

        $this->assign('result', array(
            'catid' => $id,
            'listNews' => $news,
            'pageres' => $pageres,
        ));
        $this->display();
    }
}
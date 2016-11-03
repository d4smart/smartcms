<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/11/3
 * Time: 10:50
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;
use Think\Controller;

class DetailController extends CommonController
{
    public function index() {
        $id = intval(I('id'));
        if (!$id || $id <= 0) {
            $this->error("ID不合法！");
        }

        $news = D("News")->find($id);
        if (!$news || $news['status'] != 1) {
            return $this->error("ID不存在或资讯被关闭！");
        }

        // 计数器加一
        $count = intval($news['count']) + 1;
        D("News")->updateCount($id, $count);

        $content = D("NewsContent")->find($id);
        $news['content'] = htmlspecialchars_decode($content['content']);

        // 获取文章排行
        $rankNews = $this->getRank();
        // 广告位数据
        $advNews = D("PositionContent")->select(array('status'=>1, 'position_id'=>3), 3);

        $this->assign('result', array(
            'rankNews' => $rankNews,
            'advNews' => $advNews,
            'catid' => $news['catid'],
            'news' => $news,
        ));
        $this->display("Detail/index");
    }

    public function view() {
        if (!getLoginUsername()) {
            $this->error("您没有权限访问该页面！");
        }

        $this->index();
    }
}
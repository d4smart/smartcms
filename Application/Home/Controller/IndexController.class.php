<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class IndexController extends CommonController
{
    public function index($type='') {
        // 获取首页大图数据
        $topPicNews = D("PositionContent")->select(array('status'=>1, 'position_id'=>1), 1);
        // 首页3张小图推荐
        $topSmallNews = D("PositionContent")->select(array('status'=>1, 'position_id'=>2), 3);
        // 首页新闻
        $listNews = D("News")->select(array('status'=>1, 'thumb'=>array('neq','')), 30);
        // 广告位数据
        $advNews = D("PositionContent")->select(array('status'=>1, 'position_id'=>3), 3);
        // 获取文章排行
        $rankNews = $this->getRank();

        $this->assign('result', array(
            'topPicNews' => $topPicNews,
            'topSmallNews' => $topSmallNews,
            'listNews' => $listNews,
            'advNews' => $advNews,
            'rankNews' => $rankNews,
            'catid' => 0,
        ));
        // 生成页面静态化
        if ($type == 'buildHtml') {
            $this->buildHtml('index', HTML_PATH, 'Index/index');
        } else {
            $this->display();
        }
    }

    public function build_html() {
        $this->index('buildHtml');
        return show(1, "首页缓存成功！");
    }

    public function crontab_build_html() {
        if (APP_CRONTAB != 1) {
            die("The file must exec by crontab.");
        }
        $result = D("Basic")->select();
        if (!$result['cacheindex']) {
            die("系统缓存未开启");
        }
        $this->index('buildHtml');
    }

    public function getCount() {
        if (!$_POST) {
            return show(0, "没有任何内容！");
        }

        $newsIds = array_unique($_POST);

        try {
            $list = D("News")->getNewsByNewsIdIn($newsIds);
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

        if (!$list) {
            return show(0, "not data");
        }

        $data = array();
        foreach ($list as $k=>$v) {
            $data[$v['news_id']] = $v['count'];
        }

        return show(1, "success", $data);
    }
}
<?php
/**
 * 首页控制器
 */

namespace Home\Controller;
use Think\Exception;

class IndexController extends CommonController
{
    /**
     * 前台首页控制器
     * 渲染首页，并根据参数展示或生成缓存
     * @param string $type 额外参数，指定操作类型
     */
    public function index($type='') {
        // 获取首页大图数据
        $topPicNews = D("PositionContent")->select(array('status'=>1, 'position_id'=>1), 1);
        // 首页3张小图推荐
        $topSmallNews = D("PositionContent")->select(array('status'=>1, 'position_id'=>2), 3);
        // 首页新闻
        $listNews = D("News")->getNews(array('status'=>1, 'thumb'=>array('neq','')), 1, 30);

        $this->assign('result', array(
            'topPicNews' => $topPicNews,
            'topSmallNews' => $topSmallNews,
            'listNews' => $listNews,
            'catid' => 0,
        ));

        // 根据传入参数生成页面静态化文件或渲染首页模板
        if ($type == 'buildHtml') {
            $this->buildHtml('index', HTML_PATH, 'Index/index'); // 生成静态化页面
        } else {
            $this->display(); // 渲染首页模板并显示
        }
    }

    /**
     * 更新首页缓存控制器（通过url触发）
     * 调用index方法，生成首页缓存并返回状态信息
     */
    public function build_html() {
        $this->index('buildHtml');
        return show(1, "首页缓存成功！");
    }

    /**
     * 更新首页缓存控制器（通过crontab触发）
     * 判断请求是否合法，合法则生成首页缓存
     */
    public function crontab_build_html() {
        // 判断是否通过cron.php入口执行（不能通过网页访问执行）
        if (APP_CRONTAB != 1) {
            die("The file must exec by CronTab.");
        }
        // 判断缓存是否开启
        $result = D("Basic")->select();
        if (!$result['cacheindex']) {
            die("系统缓存未开启");
        }

        $this->index('buildHtml');
    }

    /**
     * 文章阅读数控制器
     * 根据传入的文章id返回文章的阅读数信息
     */
    public function getCount() {
        if (!$_POST) {
            return show(0, "没有提交任何内容！");
        }

        // 获取文章信息
        $newsIds = array_unique($_POST);
        try {
            $list = D("News")->getNewsByNewsIdIn($newsIds);
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        if (!$list) {
            return show(0, "No data.");
        }

        $data = array();
        // 获取文章的阅读数
        foreach ($list as $k=>$v) {
            $data[$v['news_id']] = $v['count'];
        }
        return show(1, "success", $data); // 返回阅读数信息
    }
}
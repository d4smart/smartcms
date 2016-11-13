<?php
/**
 * Desp: 文章控制器
 * User: d4smart
 * Date: 2016/11/3
 * Time: 10:50
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;

class DetailController extends CommonController
{
    /**
     * 文章页面控制器
     * 渲染并展示文章页面
     * @param string $type 额外参数，指定浏览类型
     */
    public function index($type='') {
        // 合法性判断
        $id = intval(I('id'));
        if (!$id || $id <= 0) {
            $this->error("ID不合法！");
        }

        $news = D("News")->find($id);
        if ($type != 'preview' && (!$news || $news['status'] != 1)) {
            return $this->error("文章不存在或资讯被关闭！");
        }

        // 计数器加一
        $count = intval($news['count']) + 1;
        D("News")->updateCount($id, $count);

        $content = D("NewsContent")->find($id);
        $news['content'] = htmlspecialchars_decode($content['content']);
        $menu = D("Menu")->find($news['catid']);
        $news['menu'] = $menu['name'];

        $this->assign('result', array('catid' => $news['catid']));
        $this->assign('vo', $news);
        $this->display("Detail/index");
    }

    /**
     * 后台浏览入口控制器
     * 能够预览一些状态为关闭的文章
     */
    public function view() {
        // 权限判断
        if (!getLoginUsername()) {
            $this->error("您没有权限访问该页面！");
            return;
        }

        $this->index('preview'); // 调用index方法并传入额外参数
    }
}
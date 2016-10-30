<?php
/**
 * Desp:
 * User: d4smart
 * Date: 2016/10/28
 * Time: 11:50
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Controller;

class ContentController extends CommonController
{
    public function index() {
        $conds = array();

        $title = I('title');
        $catid = I('catid');
        if ($title) {
            $conds['title'] = $title;
            $this->assign('title', $title);
        }
        if ($catid) {
            $conds['catid'] = intval($catid);
            $this->assign('cateid', $conds['catid']);
        }

        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 10;
        $news = D("News")->getNews($conds, $page, $pageSize);
        $count = D("News")->getNewsCount($conds);

        $res = new \Think\Page($count, $pageSize);
        $pageres = $res->show();

        $this->assign('pageres', $pageres);
        $this->assign('news', $news);
        $this->assign('websiteMenu', D("Menu")->getBarMenus());
        $this->display();
    }

    public function add() {
        if ($_POST) {
            if (!isset($_POST['title']) || !$_POST['title']) {
                return show(0, "标题不存在！");
            }
            if (!isset($_POST['small_title']) || !$_POST['small_title']) {
                return show(0, "短标题不存在！");
            }
            if (!isset($_POST['catid']) || !$_POST['catid']) {
                return show(0, "文章栏目不存在！");
            }
            if (!isset($_POST['keywords']) || !$_POST['keywords']) {
                return show(0, "关键字不存在！");
            }
            if (!isset($_POST['content']) || !$_POST['content']) {
                return show(0, "content不存在！");
            }

            $newsId = D("News")->insert($_POST);
            if ($newsId) {
                $newsContent['content'] = $_POST['content'];
                $newsContent['news_id'] = $newsId;
                $cid = D("NewsContent")->insert($newsContent);

                if ($cid) {
                    return show(1, "新增成功！");
                } else {
                    return show(0, "主表插入成功，副表插入失败！");
                }
            } else {
                return show(0, "插入失败！");
            }

        } else {
            $websiteMenu = D("Menu")->getBarMenus();
            $titleFontColor = C("TITLE_FONT_COLOR");
            $copyFrom = C("COPY_FROM");

            $this->assign('websiteMenu', $websiteMenu);
            $this->assign('titleFontColor', $titleFontColor);
            $this->assign('copyFrom', $copyFrom);

            $this->display();
        }

    }
}
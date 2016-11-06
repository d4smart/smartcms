<?php
/**
 * Desp: 文章控制器
 * User: d4smart
 * Date: 2016/10/28
 * Time: 11:50
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Admin\Controller;
use Think\Exception;

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
        $positions = D("Position")->getNormalPositions();

        $this->assign('positions', $positions);
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

            if (I('news_id')) {
                return $this->save($_POST);
            }

            $newsId = D("News")->insert($_POST);
            if ($newsId) {
                $newsContent['content'] = $_POST['content'];
                $newsContent['news_id'] = $newsId;
                $cid = D("NewsContent")->insert($newsContent);

                if ($cid) {
                    return show(1, "新增成功！");
                } else {
                    return show(0, "文章主表插入成功，副表插入失败！");
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

    public function edit() {
        $newsId = intval(I('id'));
        if (!$newsId) {
            $this->redirect('/admin.php?c=content');
        }
        $news = D("News")->find($newsId);
        if (!$news) {
            $this->redirect('/admin.php?c=content');
        }
        $newsContent = D("NewsContent")->find($newsId);
        if ($newsContent) {
            $news['content'] = $newsContent['content'];
        }

        $websiteMenu = D("Menu")->getBarMenus();
        $this->assign('websiteMenu', $websiteMenu);
        $this->assign('titleFontColor', C("TITLE_FONT_COLOR"));
        $this->assign('copyfrom', C("COPY_FROM"));
        $this->assign('news', $news);
        $this->display();
    }

    public function save($data) {
        $newsId = $data['news_id'];
        unset($data['news_id']);

        try {
            $id = D("News")->updateById($newsId, $data);
            $newsContentData['content'] = $data['content'];
            $conId = D("NewsContent")->updateNewsById($newsId, $newsContentData);

            if ($id === false || $conId === false) {
                return show(0, "更新失败！");
            }
            return show(1, "更新成功！");
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

    }

    public function setStatus() {
        $data = array(
            'id' => intval(I('id')),
            'status' => intval(I('status')),
        );
        return parent::setStatus($data, "News");
    }

    public function listorder() {
        parent::listorder("News");
    }

    public function push() {
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $positionId = intval(I('position'));
        $newsId = I('push');

        if (!$newsId || !is_array($newsId)) {
            return show(0, "请选择文章进行推荐");
        }
        if (!$positionId) {
            return show(0, "没有选择推荐位");
        }

        try {
            $news = D("News")->getNewsByNewsIdIn($newsId);
            if (!$news) {
                return show(0, "没有相关内容");
            }

            foreach ($news as $new) {
                $data = array(
                    'position_id' => $positionId,
                    'title' => $new['title'],
                    'thumb' =>$new['thumb'],
                    'news_id' => $new['news_id'],
                    'status' => 1,
                    'create_time' => $new['create_time'],
                );
                D("PositionContent")->insert($data);
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

        return show(1, "推荐成功！", array('jump_url'=>$jumpUrl));
    }
}
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
    /**
     * 后台文章内容页面
     * 根据可选的传入的查询条件和页码，分页显示文章数据
     */
    public function index() {
        $conditions = array();

        $title = I('title');
        $catid = I('catid');
        if ($title) {
            $conditions['title'] = $title;
            $this->assign('title', $title);
        }
        if ($catid) {
            $conditions['catid'] = intval($catid);
            $this->assign('cateid', $conditions['catid']);
        }

        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 10;
        $news = D("News")->getNews($conditions, $page, $pageSize);
        $count = D("News")->getNewsCount($conditions);

        $res = new \Think\Page($count, $pageSize);
        $pageres = $res->show();
        $positions = D("Position")->getNormalPositions();

        $this->assign('positions', $positions);
        $this->assign('pageres', $pageres);
        $this->assign('news', $news);
        $this->assign('websiteMenu', D("Menu")->getBarMenus());
        $this->display();
    }

    /**
     * 文章添加
     * 如果有提交的post数据，就添加文章数据并返回结果；否则显示文章添加页面
     */
    public function add() {
        if ($_POST) {
            if (I('news_id')) {
                return $this->save();
            }

            $news = D('News');
            $newsContent = D('NewsContent');

            if ($news->create($_POST)) {
                $news_id = $news->add();
                if ($news_id) {
                    $news_content['news_id'] = $news_id;
                    $news_content['content'] = htmlspecialchars($_POST['content']);

                    if ($newsContent->create($news_content)) {
                        if ($newsContent->add()) {
                            return show(1, "新增成功！");
                        } else {
                            return show(0, "文章主表插入成功，副表插入失败！");
                        }
                    } else {
                        return show(0, $newsContent->getError());
                    }
                } else {
                    return show(0, "添加失败！");
                }
            } else {
                return show(0, $news->getError());
            }
        }

        $websiteMenu = D("Menu")->getBarMenus();
        $titleFontColor = C("TITLE_FONT_COLOR");
        $copyFrom = C("COPY_FROM");

        $this->assign('websiteMenu', $websiteMenu);
        $this->assign('titleFontColor', $titleFontColor);
        $this->assign('copyFrom', $copyFrom);

        $this->display();
    }

    /**
     * 后台文章编辑页面
     * 判断编辑请求的合法性，并显示文章编辑页面
     */
    public function edit() {
        // 是否传递了文章id值
        $newsId = intval(I('id'));
        if (!$newsId) {
            $this->redirect('/admin.php?c=content');
        }

        // 数据库里是否能找到文章的信息和内容
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

    /**
     * 文章保存方法
     * 保存提交的文章数据，并作出相应
     */
    public function save() {
        $news = D('News');
        $newsContent = D('NewsContent');
        $newsId = $_POST['news_id'];

        if ($news->create($_POST)) {
            if ($news->save()) {
                $news_content['content'] = htmlspecialchars($_POST['content']);

                if ($newsContent->create($news_content)) {
                    if ($newsContent->where(array('news_id'=>$newsId))->save()) {
                        return show(1, "更新成功！");
                    } else {
                        return show(0, "文章主表更新成功，副表更新失败！");
                    }
                } else {
                    return show(0, $newsContent->getError());
                }
            } else {
                return show(0, "更新失败！");
            }
        } else {
            return show(0, $news->getError());
        }
    }

    /**
     * 更改文章状态的方法
     * 更改文章文章的状态，并返回结果
     */
    public function setStatus() {
        $news = D('News');
        $res = $news->updateStatusById(I('id'), I('status'));
        if ($res) {
            return show(1, "操作成功！");
        } else {
            return show(0, "操作失败！");
        }
    }

    /**
     * 文章排序方法
     * 调用父类的公共方法
     */
    public function listorder() {
        parent::listorder("News");
    }

    /**
     * 文章推送方法
     * 获取文章推送的数据，在合法性检查后，将数据添加到推荐位内容中
     */
    public function push() {
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $positionId = intval(I('position'));
        $newsId = I('push');

        // 合法性检查
        if (!$newsId || !is_array($newsId)) {
            return show(0, "请选择文章进行推荐");
        }
        if (!$positionId) {
            return show(0, "没有选择推荐位");
        }

        try {
            $position_content = D('PositionContent');
            $news = D("News")->getNewsByNewsIdIn($newsId);
            if (!$news) {
                return show(0, "没有相关内容");
            }

            // 将数据添加到推荐位内容中
            foreach ($news as $new) {
                $data = array(
                    'position_id' => $positionId,
                    'title' => $new['title'],
                    'thumb' =>$new['thumb'],
                    'news_id' => $new['news_id'],
                    'status' => 1,
                );
                $position_content->add($data);
            }
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }

        return show(1, "推荐成功！", array('jump_url'=>$jumpUrl));
    }
}
<?php
/**
 * Desp: 前台模块公共控制器，拥有一些公共方法
 * User: d4smart
 * Date: 2016/11/2
 * Time: 12:46
 * Email:   d4smart@foxmail.com
 * Github:  https://github.com/d4smart
 */

namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller
{
    public function __construct() {
        header("Content-type: text/html; charset=utf-8");
        parent::__construct();

        // 获取网站配置
        $data['config'] = D("Basic")->select();
        // 获取菜单栏
        $data['navs'] = D("Menu")->getBarMenus();
        // 获取文章排行
        $data['rankNews'] = $this->getRank();
        // 广告位数据
        $data['advNews'] = D("PositionContent")->select(array('status'=>1, 'position_id'=>3), 3);

        $this->assign($data);
    }

    public function getRank() {
        $conditions['status'] = 1;
        $news = D("News")->getRank($conditions, 10);
        return $news;
    }

    public function error($message='') {
        $message = $message ? $message : "系统发生错误QAQ";

        // 获取网站配置
        $data['config'] = D("Basic")->select();
        // 获取菜单栏
        $data['navs'] = D("Menu")->getBarMenus();
        $this->assign($data);
        $this->assign('message', $message);

        $this->display("Public/error");
    }
}